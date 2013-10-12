<?php

/**
 * This is the model class for table "crew".
 *
 * The followings are the available columns in table 'crew':
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property integer $lost_id
 * @property integer $coordinator_id
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property Lost $lost
 * @property Coordinator $coordinator
 */
class Crew extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Crew the static model class
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
        return 'crew';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, lost_id, coordinator_id', 'required'),
            array('active, lost_id, coordinator_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 200),
            array('date_created', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, active, lost_id, coordinator_id, date_created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'lost' => array(self::BELONGS_TO, 'Lost', 'lost_id'),
            'coordinator' => array(self::BELONGS_TO, 'Coordinator', 'coordinator_id'),
            'volunteer' => array(self::MANY_MANY, 'Volunteer', 'volunteer_crew(crew_id,volunteer_id)'),
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
            'active' => 'Активность',
            'lost_id' => 'Номер потерявшки',
            'coordinator_id' => 'Номер координатора',
            'date_created' => 'Дата создания',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('lost_id', $this->lost_id);
        $criteria->compare('coordinator_id', $this->coordinator_id);
        $criteria->compare('date_created', $this->date_created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}