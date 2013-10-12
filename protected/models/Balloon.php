<?php

/**
 * This is the model class for table "balloon".
 *
 * The followings are the available columns in table 'balloon':
 * @property string $title
 * @property string $description
 * @property string $lat
 * @property string $long
 * @property string $url
 * @property integer $lost_id
 * @property string $user
 * @property string $date_created
 * @property string $id
 *
 * The followings are the available model relations:
 * @property Lost $lost
 */
class Balloon extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Balloon the static model class
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
        return 'balloon';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
         return array(
            array('lost_id', 'numerical', 'integerOnly'=>true),
            array('title, lat, lng, url', 'length', 'max'=>255),
            array('user', 'length', 'max'=>1),
            array('description, date_created, color', 'safe'),
            
            array('title, description, lat, lng, url, lost_id, user, date_created, id', 'safe', 'on'=>'search'),
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
            'url' => 'Url',
            'lost_id' => 'Lost',
            'user' => 'User',
            'date_created' => 'Date Created',
            'id' => 'ID',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        return new CActiveDataProvider($this, array(
            'criteria' => $this->search_criteria(),
        ));
    }

    public function search_criteria()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('lost_id', $this->lost_id);

        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('lat', $this->lat, true);
        $criteria->compare('long', $this->long, true);
        $criteria->compare('url', $this->url, true);

        $criteria->compare('user', $this->user, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('id', $this->id, true);
        
        return $criteria;
    }

}