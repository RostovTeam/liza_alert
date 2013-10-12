<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $login
 * @property string $password
 * @property string $salt
 */
class User extends CActiveRecord
{

    public $password_save;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('login, password', 'required'),
            array('login', 'length', 'max' => 50),
            array('password, salt', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_id, login, password, salt', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'user_id' => 'User',
            'login' => 'Login',
            'password' => 'Password',
            'salt' => 'Salt',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('login', $this->login, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave()
    {
        if (parent::beforeSave())
        {
            $this->salt = $this->generateSalt();
            $this->password_save = $this->password;
            $this->password = $this->hashPassword($this->password, $this->salt);
            return true;
        }
        return false;
    }

    public function afterSave()
    {
        if (parent::afterSave())
        {
            $this->password = $this->password_save;
        }
        return false;
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

    public function hashPassword($password, $salt)
    {
        return md5(md5($salt) . $password);
    }

    protected function generateSalt()
    {
        return uniqid('', true);
    }

}