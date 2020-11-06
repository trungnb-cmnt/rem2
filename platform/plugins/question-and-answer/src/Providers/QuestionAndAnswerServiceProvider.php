<?php

namespace Botble\QuestionAndAnswer\Providers;

use Botble\QuestionAndAnswer\Models\QuestionAndAnswer;
use Illuminate\Support\ServiceProvider;
use Botble\QuestionAndAnswer\Repositories\Caches\QuestionAndAnswerCacheDecorator;
use Botble\QuestionAndAnswer\Repositories\Eloquent\QuestionAndAnswerRepository;
use Botble\QuestionAndAnswer\Repositories\Interfaces\QuestionAndAnswerInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class QuestionAndAnswerServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(QuestionAndAnswerInterface::class, function () {
            return new QuestionAndAnswerCacheDecorator(new QuestionAndAnswerRepository(new QuestionAndAnswer));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/question-and-answer')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-question_and_answer',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/question-and-answer::question-and-answer.name',
                'icon'        => 'fa fa-list',
                'url'         => route('question_and_answer.list'),
                'permissions' => ['question_and_answer.list'],
            ]);
        });
    }
}
