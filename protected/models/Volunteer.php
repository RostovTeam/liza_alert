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
        return array(
            array('name, phone', 'required'),
            array('name', 'length', 'max' => 200),
            array('phone', 'length', 'max' => 50),
            array('date_created', 'safe'),
            array('id, name, phone, date_created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {

        return array(
            'crew' => array(self::MANY_MANY, 'Crew', 'volunteer_crew(volunteer_id,crew_id)'),
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

        if (!$model->validate())
        {
            return $model;
        }

        $ex_model = Volunteer::model()->findByAttributes(array('phone' => $data['phone']));

        if (!empty($ex_model))
        {
            return $ex_model;
        }

        if ($model->save())
            return $model;
        else
            return false;
    }

    public function AvailableCrew()
    {
        $crit = new CDBCriteria;
        $crit->addCondition('id not in(select crew_id from volunteer_crew vc
                    join volunteer v on vc.volunteer_id=v.id where vc.volunteer_id=:volunteer_id )');
        $crit->params=array(':volunteer_id'=>$this->id);

        $crit->compare('active',1);
        return Crew::model()->findAll($crit);
    }

}