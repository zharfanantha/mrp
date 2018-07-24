<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Uji Sentimen';
?>

<div class="fh5co-parallax" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/pantaibalekambang.jpg"; ?>);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
					<div class="fh5co-intro fh5co-table-cell">
						<h1 class="text-center">Uji Sentimen Analisis</h1>
						<p>Positif Negatif Netral</p>
					</div>
				</div>
			</div>
		</div>
	</div>

<div id="fh5co-blog-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title text-center">
                    <br><br>
                    <h2>Sentimen Analisis</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>
                    
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-5">
                            <?= Html::textArea('xxx'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-5">
                            <?= Html::submitButton('Uji Sentimen', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
                <div class="form-group">
                    <div class="col-md-12 col-md-offset-4">
                        <?php if(isset($kalimat)) {
                            echo "Hasil:";
                            echo "<br>Kalimat: <b>$kalimat</b>\n";
                            echo "<br>Arah sentimen: <b>$kategori</b>, nilai: ";
                            echo $nilai;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>