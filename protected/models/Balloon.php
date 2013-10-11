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
	public static function model($className=__CLASS__)
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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lost_id', 'numerical', 'integerOnly'=>true),
			array('title, lat, long, url', 'length', 'max'=>255),
			array('user', 'length', 'max'=>1),
			array('description, date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, description, lat, long, url, lost_id, user, date_created, id', 'safe', 'on'=>'search'),
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
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('long',$this->long,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('lost_id',$this->lost_id);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('id',$this->id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}