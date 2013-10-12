<?php

/**
 * This is the model class for table "radius".
 *
 * The followings are the available columns in table 'radius':
 * @property string $title
 * @property string $description
 * @property string $lat
 * @property string $long
 * @property integer $lost_id
 * @property string $date_created
 * @property integer $radius
 * @property string $id
 *
 * The followings are the available model relations:
 * @property Lost $lost
 */
class Radius extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Radius the static model class
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
        return 'radar';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('lost_id, radius', 'numerical', 'integerOnly' => true),
            array('title, lat, lng', 'length', 'max' => 255),
            array('description, color,radius', 'safe'),
            array('title, description, lat, lng, lost_id, date_created, radius, id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'lost' => array(self::BELONGS_TO, 'Lost', 'lost_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'title' => 'Title',
            'description' => 'Description',
            'lat' => 'Lat',
            'long' => 'Long',
            'lost_id' => 'Lost',
            'date_created' => 'Date Created',
            'radius' => 'Radius',
            'id' => 'ID',
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

        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('lat', $this->lat, true);
        $criteria->compare('long', $this->long, true);
        $criteria->compare('lost_id', $this->lost_id);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('radius', $this->radius);
        $criteria->compare('id', $this->id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}