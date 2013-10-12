<?php

/**
 * This is the model class for table "volunteer".
 *
 * The followings are the available columns in table 'volunteer':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $date_created
 */
class Volunteer extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Volunteer the static model class
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
        return 'volunteer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, phone', 'required'),
            array('name', 'length', 'max' => 200),
            array('phone', 'length', 'max' => 50),
            array('date_created', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, phone, date_created', 'safe', 'on' => 'search'),
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
            'id' => 'Номер',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'date_created' => 'Дата создания',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('date_created', $this->date_created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function create($data)
    {
        $model = new Volunteer;

        $model->attributes = $data;

        if (!$model->validate)
        {
            return $model;
        }

        $ex_model = Volunteer::model()->findByAttibutes(array('phone' => $data['phone']));

        if (!empty($ex_model))
        {
            return $ex_model;
        }

        if ($model->save())
            return $model;
        else
            return false;
    }

}