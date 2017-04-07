<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\Users;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

?> 
<div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Пользователи</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>
                <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-3">
                    <span>Фильтр:</span>
                  </div>
                  <div class="col col-xs-9 text-right">
                      <?php
                      $role_id = [0=> 'e-mail не подтвержден'];
                        foreach($role as $v) $role_id[$v->id] = $v->title;
                      
                       $form = ActiveForm::begin( ['options' => [
                                                        'class' => 'filter'
                                                     ]]);
                            echo $form->field($filter, 'text')->textInput(['value'=>$post['text']]);
                            echo $form->field($filter, 'role_id')->dropDownList($role_id,['options' =>[ $post['role_id'] => ['Selected' => true]]]);
                            echo Html::submitButton("Фильтр",['class'=>"btn btn-defaul"]);
                        ActiveForm::end()
                      ?>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th class="hidden-xs">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                    </tr> 
                  </thead>
                  <tbody>
                      <?php
                      foreach($user as $v){
                      ?>
                       <tr>
                            <td align="center">
                              <a class="btn btn-default" href="<?=Yii::$app->urlManager->createUrl(['admin/edit','id'=>$v->id])?>"><em class="fa fa-pencil"></em></a>
                              <a class="btn btn-danger" href="<?=Yii::$app->urlManager->createUrl(['admin/delete','id'=>$v->id])?>"><em class="fa fa-trash"></em></a>
                            </td>
                            <td class="hidden-xs"><?=$v->id?></td>
                            <td><?=$v->name?></td>
                            <td><?=$v->email?></td>
                            <td><?=$v->phone?></td>
                            <td><?=(($v->name_role)?$v->name_role:"e-mail не подтвержден")?></td>
                          </tr>
                      <?php
                      }
                      ?>
                         
                        </tbody>
                </table>
            
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col col-xs-9">
                  </div>
                  <?= LinkPager::widget(['pagination'=>$pagination])?>
                </div>
              </div>
            </div>

</div>