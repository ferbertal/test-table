<?php

namespace app\models\form;

use app\models\User;
use yii\base\Exception;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [ 'name', 'trim' ],
            [ 'name', 'required' ],
            [
                'name',
                'unique',
                'targetClass' => User::className(),
                'message'     => 'This name has already been taken.',
            ],
            [ 'name', 'string', 'min' => 2, 'max' => 255 ],
            [ 'email', 'trim' ],
            [ 'email', 'required' ],
            [ 'email', 'email' ],
            [ 'email', 'string', 'max' => 255 ],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message'     => 'This email address has already been taken.',
            ],
            [ 'password', 'required' ],
            [ 'password', 'string', 'min' => 6 ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function signup(): ?User
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);

        return $user->save() ? $user : null;
    }
}