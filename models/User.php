<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string $password
 * @property int $role
 *
 * @property Publication[] $publications
 */
class User extends ActiveRecord implements IdentityInterface
{
    const USER_ROLE_ADMIN = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [ [ 'email', 'password' ], 'required' ],
            [ [ 'role' ], 'integer' ],
            [ [ 'name', 'email', 'password' ], 'string', 'max' => 255 ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id'       => 'ID',
            'name'     => 'Name',
            'email'    => 'Email',
            'password' => 'Password',
            'role'     => 'Role',
        ];
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return ActiveQuery
     */
    public function getPublications(): ActiveQuery
    {
        return $this->hasMany(Publication::class, [ 'author_id' => 'id' ]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id): ?IdentityInterface
    {
        return static::findOne([ 'id' => $id ]);
    }

    /**
     * @inheritdoc
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by name
     *
     * @param string $name
     * @return static|null
     */
    public static function findByUsername(string $name): ?User
    {
        return static::findOne([ 'name' => $name ]);
    }

    /**
     * @inheritdoc
     */
    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey(): ?string
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey): ?bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws Exception
     */
    public function setPassword(string $password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return self::USER_ROLE_ADMIN === $this->role;
    }
}
