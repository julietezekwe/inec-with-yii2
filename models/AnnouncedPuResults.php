<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "announced_pu_results".
 *
 * @property integer $result_id
 * @property string $polling_unit_uniqueid
 * @property string $party_abbreviation
 * @property integer $party_score
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class AnnouncedPuResults extends \yii\db\ActiveRecord
{

    public $lga_id;
    public $polling_unit_id;
    public $polling_unit_name;
    public $polling_unit_number;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announced_pu_results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['polling_unit_uniqueid', 'party_abbreviation', 'party_score', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['party_score'], 'integer'],
            [['date_entered'], 'safe'],
            [['polling_unit_uniqueid', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['party_abbreviation'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'result_id' => 'Result ID',
            'lga_id' => 'Lga ID',
            'polling_unit_id' => 'polling ID',
            'polling_unit_name' => 'polling Name',
            'polling_unit_number' => 'polling Number',
            'polling_unit_uniqueid' => 'Polling Unit Uniqueid',
            'party_abbreviation' => 'Party Abbreviation',
            'party_score' => 'Party Score',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
         
        ];
    }

    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollingunit()
    {
        return $this->hasOne(PollingUnit::className(), ['Uniqueid' => 'polling_unit_uniqueid']);
    }

     public function getlga()
    {
        return $this->hasOne(Ward::className(), ['lga_id' => 'lga_id']);
    }
    public function getParty()
    {
        return $this->hasOne(Party::className(), ['id' => 'party_abbreviation']);
    }
    
}
