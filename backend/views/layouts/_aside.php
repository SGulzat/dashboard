<?php
use yii\helpers\Url;
use common\widgets\Sidebar;
?>
<aside class="main-sidebar">
    <a href="<?= Url::to(['/'])?>" class="mini-logo visible-xs">
        <span class="logo-lg">Admin</span>
    </a>
    <section class="sidebar">
        <?= Sidebar::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                'linkTemplate' => '<a href="{url}">{icon} {label}</a>',
                'activeCssClass' => 'active',
                'items' => [
                    [
                        'label' => 'Меню',
                        'options' => [
                            'class' => 'header'
                        ],
                    ],
                    [
                        'label' => 'Главная',
                        'url' => ['/site/index'],
                        'icon' => 'fa-home',
                        'void' => true,
                    ],
                    [
                        'label' => 'Отделы',
                        'url' => ['/department'],
                        'icon' => 'fa-university',
                        'void' => true,
                    ],
                    [
                        'label' => 'Уровни разработчика',
                        'url' => ['/developer-level'],
                        'icon' => 'fa-line-chart',
                        'void' => true,
                    ],
                    [
                        'label' => 'Уровни задач',
                        'url' => ['/task-level'],
                        'icon' => 'fa-bar-chart',
                        'void' => true,
                    ],
                    [
                        'label' => 'Сотрудники',
                        'url' => ['/employees'],
                        'icon' => 'fa-users',
                        'void' => true,
                    ],
                    [
                        'label' => 'Задачи',
                        'url' => ['/tasks'],
                        'icon' => 'fa-tasks',
                        'void' => true,
                    ],
                    [
                        'label' => 'Назначение задач',
                        'url' => ['/task-assign'],
                        'icon' => 'fa-address-card',
                        'void' => true,
                    ],
                    [
                        'label' => 'Отчеты',
                        'url' => ['/tasks-report'],
                        'icon' => 'fa-bar-chart',
                        'void' => true,
                    ]
                    /*[
                        'label' => Yii::t('app', 'Matching'),
                        'icon' => 'fa-compress aria-hidden="true"',
                        'url' => '',
                        'items' => [
                            [
                                'label' => Yii::t('app', 'Medicament'),
                                'url' => ['/matching/index'],
                                'icon' => 'none',
                            ],
                        ]
                    ],*/
                ]
            ]
        );
        ?>
    </section>
    <div class="aside-footer-menu">
        <ul class="aside-footer-menu__list">
            <li class="aside-footer-menu__item">
                <a class="aside-footer-menu__link" href="<?= Url::to(['/site/about'])?>">
                    <i class="fa fa-copyright"></i>
                </a>
            </li>
            <li class="aside-footer-menu__item">
                <a class="aside-footer-menu__link" href="<?= Url::to(['/site/logout'])?>" data-method="post">
                    <i class="fa fa-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
</aside>