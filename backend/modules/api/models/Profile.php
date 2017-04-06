<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $public_email
 * @property string $gravatar_email
 * @property string $gravatar_id
 * @property string $location
 * @property string $website
 * @property string $bio
 * @property string $timezone
 * @property integer $idTipo
 * @property integer $idCareer
 * @property integer $idUniversity
 * @property integer $idColegio
 * @property integer $cedula
 * @property string $fechaNacimiento
 * @property integer $age
 * @property string $nombres
 * @property string $apellidos
 * @property string $telefonos
 * @property string $cargo
 * @property integer $cantidadPreguntas
 * @property integer $cantidadResBuenas
 * @property integer $cantidadResMalas
 *
 * @property User $user
 * @property Career $idCareer0
 * @property School $idColegio0
 * @property Usertype $idTipo0
 * @property Studenttest[] $studenttests
 * @property Userresponse[] $userresponses
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'idTipo', 'idCareer', 'idUniversity', 'idColegio', 'cedula', 'age', 'cantidadPreguntas', 'cantidadResBuenas', 'cantidadResMalas'], 'integer'],
            [['bio'], 'string'],
            [['fechaNacimiento'], 'safe'],
            [['name', 'public_email', 'gravatar_email', 'location', 'website', 'nombres', 'apellidos'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32],
            [['timezone'], 'string', 'max' => 40],
            [['telefonos'], 'string', 'max' => 20],
            [['cargo'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['idCareer'], 'exist', 'skipOnError' => true, 'targetClass' => Career::className(), 'targetAttribute' => ['idCareer' => 'id']],
            [['idColegio'], 'exist', 'skipOnError' => true, 'targetClass' => School::className(), 'targetAttribute' => ['idColegio' => 'id']],
            [['idTipo'], 'exist', 'skipOnError' => true, 'targetClass' => Usertype::className(), 'targetAttribute' => ['idTipo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('yii', 'User ID'),
            'name' => Yii::t('yii', 'Name'),
            'public_email' => Yii::t('yii', 'Public Email'),
            'gravatar_email' => Yii::t('yii', 'Gravatar Email'),
            'gravatar_id' => Yii::t('yii', 'Gravatar ID'),
            'location' => Yii::t('yii', 'Location'),
            'website' => Yii::t('yii', 'Website'),
            'bio' => Yii::t('yii', 'Bio'),
            'timezone' => Yii::t('yii', 'Timezone'),
            'idTipo' => Yii::t('yii', 'Id Tipo'),
            'idCareer' => Yii::t('yii', 'Id Career'),
            'idUniversity' => Yii::t('yii', 'Id University'),
            'idColegio' => Yii::t('yii', 'Id Colegio'),
            'cedula' => Yii::t('yii', 'Cedula'),
            'fechaNacimiento' => Yii::t('yii', 'Fecha Nacimiento'),
            'age' => Yii::t('yii', 'Age'),
            'nombres' => Yii::t('yii', 'Nombres'),
            'apellidos' => Yii::t('yii', 'Apellidos'),
            'telefonos' => Yii::t('yii', 'Telefonos'),
            'cargo' => Yii::t('yii', 'Cargo'),
            'cantidadPreguntas' => Yii::t('yii', 'Cantidad Preguntas'),
            'cantidadResBuenas' => Yii::t('yii', 'Cantidad Res Buenas'),
            'cantidadResMalas' => Yii::t('yii', 'Cantidad Res Malas'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCareer0()
    {
        return $this->hasOne(Career::className(), ['id' => 'idCareer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColegio0()
    {
        return $this->hasOne(School::className(), ['id' => 'idColegio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipo0()
    {
        return $this->hasOne(Usertype::className(), ['id' => 'idTipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudenttests()
    {
        return $this->hasMany(Studenttest::className(), ['idProfile' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserresponses()
    {
        return $this->hasMany(Userresponse::className(), ['idProfile' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }
}
