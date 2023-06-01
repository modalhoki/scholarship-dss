<?php

namespace PHPMaker2021\lpdpdss;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // awardee
    $app->any('/awardeelist[/{id}]', AwardeeController::class . ':list')->add(PermissionMiddleware::class)->setName('awardeelist-awardee-list'); // list
    $app->any('/awardeeadd[/{id}]', AwardeeController::class . ':add')->add(PermissionMiddleware::class)->setName('awardeeadd-awardee-add'); // add
    $app->any('/awardeeaddopt', AwardeeController::class . ':addopt')->add(PermissionMiddleware::class)->setName('awardeeaddopt-awardee-addopt'); // addopt
    $app->any('/awardeeview[/{id}]', AwardeeController::class . ':view')->add(PermissionMiddleware::class)->setName('awardeeview-awardee-view'); // view
    $app->any('/awardeeedit[/{id}]', AwardeeController::class . ':edit')->add(PermissionMiddleware::class)->setName('awardeeedit-awardee-edit'); // edit
    $app->any('/awardeedelete[/{id}]', AwardeeController::class . ':delete')->add(PermissionMiddleware::class)->setName('awardeedelete-awardee-delete'); // delete
    $app->group(
        '/awardee',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AwardeeController::class . ':list')->add(PermissionMiddleware::class)->setName('awardee/list-awardee-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AwardeeController::class . ':add')->add(PermissionMiddleware::class)->setName('awardee/add-awardee-add-2'); // add
            $group->any('/' . Config("ADDOPT_ACTION") . '', AwardeeController::class . ':addopt')->add(PermissionMiddleware::class)->setName('awardee/addopt-awardee-addopt-2'); // addopt
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AwardeeController::class . ':view')->add(PermissionMiddleware::class)->setName('awardee/view-awardee-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AwardeeController::class . ':edit')->add(PermissionMiddleware::class)->setName('awardee/edit-awardee-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AwardeeController::class . ':delete')->add(PermissionMiddleware::class)->setName('awardee/delete-awardee-delete-2'); // delete
        }
    );

    // grade
    $app->any('/gradelist[/{id}]', GradeController::class . ':list')->add(PermissionMiddleware::class)->setName('gradelist-grade-list'); // list
    $app->any('/gradeadd[/{id}]', GradeController::class . ':add')->add(PermissionMiddleware::class)->setName('gradeadd-grade-add'); // add
    $app->any('/gradeview[/{id}]', GradeController::class . ':view')->add(PermissionMiddleware::class)->setName('gradeview-grade-view'); // view
    $app->any('/gradeedit[/{id}]', GradeController::class . ':edit')->add(PermissionMiddleware::class)->setName('gradeedit-grade-edit'); // edit
    $app->any('/gradedelete[/{id}]', GradeController::class . ':delete')->add(PermissionMiddleware::class)->setName('gradedelete-grade-delete'); // delete
    $app->any('/gradesearch', GradeController::class . ':search')->add(PermissionMiddleware::class)->setName('gradesearch-grade-search'); // search
    $app->group(
        '/grade',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', GradeController::class . ':list')->add(PermissionMiddleware::class)->setName('grade/list-grade-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', GradeController::class . ':add')->add(PermissionMiddleware::class)->setName('grade/add-grade-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', GradeController::class . ':view')->add(PermissionMiddleware::class)->setName('grade/view-grade-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', GradeController::class . ':edit')->add(PermissionMiddleware::class)->setName('grade/edit-grade-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', GradeController::class . ':delete')->add(PermissionMiddleware::class)->setName('grade/delete-grade-delete-2'); // delete
            $group->any('/' . Config("SEARCH_ACTION") . '', GradeController::class . ':search')->add(PermissionMiddleware::class)->setName('grade/search-grade-search-2'); // search
        }
    );

    // graded
    $app->any('/gradedlist', GradedController::class . ':list')->add(PermissionMiddleware::class)->setName('gradedlist-graded-list'); // list
    $app->any('/gradedsearch', GradedController::class . ':search')->add(PermissionMiddleware::class)->setName('gradedsearch-graded-search'); // search
    $app->group(
        '/graded',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', GradedController::class . ':list')->add(PermissionMiddleware::class)->setName('graded/list-graded-list-2'); // list
            $group->any('/' . Config("SEARCH_ACTION") . '', GradedController::class . ':search')->add(PermissionMiddleware::class)->setName('graded/search-graded-search-2'); // search
        }
    );

    // DetailNilai
    $app->any('/detailnilailist', DetailNilaiController::class . ':list')->add(PermissionMiddleware::class)->setName('detailnilailist-DetailNilai-list'); // list
    $app->group(
        '/detailnilai',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', DetailNilaiController::class . ':list')->add(PermissionMiddleware::class)->setName('detailnilai/list-DetailNilai-list-2'); // list
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
