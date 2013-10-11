<?php

/**
 * This is the model class for table "volunteer_crew".
 *
 * The followings are the available columns in table 'volunteer_crew':
 * @property integer $id
 * @property integer $volunteer_id
 * @property integer $crew_id
 *
 * The followings are the available model relations:
 * @property Volunteer $volunteer
 * @property Crew $crew
 */
class VolunteerCrew extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VolunteerCrew the static model class
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
		return 'volunteer_crew';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('volunteer_id, crew_id', 'required'),
			array('volunteer_id, crew_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, volunteer_id, crew_id', 'safe', 'on'=>'search'),
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
			'volunteer' => array(self::BELONGS_TO, 'Volunteer', 'volunteer_id'),
			'crew' => array(self::BELONGS_TO, 'Crew', 'crew_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'volunteer_id' => 'Volunteer',
			'crew_id' => 'Crew',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('volunteer_id',$this->volunteer_id);
		$criteria->compare('crew_id',$this->crew_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}