<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about bg-white p-5 rounded shadow mb-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="mt-4">
        <h2>Hi there 👋 I'm Lu Stormstout</h2>

        <hr>

        <ul>
            <li>🧑‍💻 I'm a web developer</li>
            <li>🖥️ I mainly use PHP for web development</li>
            <li>🌱 I'm currently learning Python, Ruby on Rails, Go</li>
            <li>🌍 I'm currently live in Earth</li>
            <li>🏎️ karting 🚴 cycling ⚽ football</li>
        </ul>
    </div>
</div>
