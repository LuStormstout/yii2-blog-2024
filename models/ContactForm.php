<?php

namespace app\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    /**
     * @var string|null the name of the person who is contacting us.
     */
    public ?string $name = null;

    /**
     * @var string|null the email address of the person who is contacting us.
     */
    public ?string $email = null;

    /**
     * @var string|null the subject of the message.
     */
    public ?string $subject = null;

    /**
     * @var string|null the body of the message.
     */
    public ?string $body = null;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],

            ['name', 'string', 'max' => 255],
            ['subject', 'string', 'max' => 255],

            ['body', 'string'],
        ];
    }
}