<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_created
 * @property string $date_updated
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord
{
	public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_created', 'date_updated', 'preview', 'date', 'author_id'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        	[['date_created', 'date_updated', 'date', 'author'], 'safe'],
            [['author_id'], 'integer'],
            [['name', 'preview'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_updated' => Yii::t('app', 'Date Updated'),
            'preview' => Yii::t('app', 'Preview'),
        	'file' => Yii::t('app', 'Preview File'),
            'date' => Yii::t('app', 'Date'),
            'author_id' => Yii::t('app', 'Author ID'),
        	'author' => Yii::t('app', 'Author')
        ];
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
}
