<?php

/**
 * This is the model class for table "area".
 *
 * The followings are the available columns in table 'area':
 * @property string $tittle
 * @property string $description
 * @property string $date_created
 * @property string $points
 * @property integer $lost_id
 * @property string $id
 *
 * The followings are the available model relations:
 * @property Lost $lost
 */
class Area extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Area the static model class
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
		return 'area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lost_id', 'required'),
			array('lost_id', 'numerical', 'integerOnly'=>true),
			array('tittle', 'length', 'max'=>255),
			array('description, date_created, points', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tittle, description, date_created, points, lost_id, id', 'safe', 'on'=>'search'),
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
			'tittle' => 'Tittle',
			'description' => 'Description',
			'date_created' => 'Date Created',
			'points' => 'Points',
			'lost_id' => 'Lost',
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

		$criteria->compare('tittle',$this->tittle,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('points',$this->points,true);
		$criteria->compare('lost_id',$this->lost_id);
		$criteria->compare('id',$this->id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}