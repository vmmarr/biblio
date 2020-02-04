<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $password
 * @property string $auth_key
 * @property string $telefono
 * @property string $poblacion
 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_CREAR = 'crear';

    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'password'], 'required'],
            [['nombre'], 'unique'],
            [['nombre', 'auth_key', 'telefono', 'poblacion'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['password_repeat'], 'required', 'on' => self::SCENARIO_CREAR],
            // [['password'], 'compare'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Contraseña',
            'password_repeat' => 'Repetir contraseña',
            'auth_key' => 'Auth Key',
            'telefono' => 'Teléfono',
            'poblacion' => 'Población',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findPorNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            if ($this->scenario === self::SCENARIO_CREAR) {
                $security = Yii::$app->security;
                $this->auth_key = $security->generateRandomString();
                $this->password = $security->generatePasswordHash($this->password);
            }
        }

        return true;
    }
}
