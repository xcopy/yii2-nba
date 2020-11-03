<?php

namespace app\components;

use Yii;
use Exception;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Auth;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /** @var ClientInterface */
    private ClientInterface $client;

    /**
     * AuthHandler constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Handles auth client
     *
     * @throws Exception
     * @return void
     * @todo Facebook only
     */
    public function handle(): void
    {
        $attributes = $this->client->getUserAttributes();

        $id = ArrayHelper::getValue($attributes, 'id');
        $email = ArrayHelper::getValue($attributes, 'email');

        [$username] = explode('@', $email);

        $login = ArrayHelper::getValue($attributes, 'login', $username);

        /* @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $id
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                /* @var User $user */
                $user = $auth->user;

                Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
            } else { // signup
                if ($email !== null && User::find()->where(['email' => $email])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $this->client->getTitle()])
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);

                    $user = new User([
                        'username' => $login,
                        'email' => $email
                    ]);

                    $user->setPassword($password)
                        ->generateAuthKey()
                        ->generateTokens();

                    $transaction = User::getDb()->beginTransaction();

                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $this->client->getId(),
                            'source_id' => (string) $id
                        ]);

                        if ($auth->save()) {
                            $transaction->commit();

                            Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
                        } else {
                            Yii::$app->getSession()->setFlash('error', [
                                Yii::t('app', 'Unable to save {client} account: {errors}', [
                                    'client' => $this->client->getTitle(),
                                    'errors' => json_encode($auth->getErrors())
                                ])
                            ]);
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Unable to save user: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($user->getErrors())
                            ])
                        ]);
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string)$attributes['id']
                ]);

                $auth->save()
                    ? Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', 'Linked {client} account.', ['client' => $this->client->getTitle()])
                    ])
                    : Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ])
                    ]);
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app', 'Unable to link {client} account. There is another user using it.', [
                        'client' => $this->client->getTitle()
                    ])
                ]);
            }
        }
    }
}
