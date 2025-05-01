<?php
namespace Amerhendy\PageManger\App\Http\Controllers;
use \Amerhendy\PageManger\App\Models\Pages as Pages;
use Illuminate\Support\Facades\DB;
use \Amerhendy\Amer\App\Http\Controllers\Base\AmerController;
use \Amerhendy\Amer\App\Helpers\Library\AmerPanel\AmerPanelFacade as AMER;
use Amerhendy\PageManger\App\PageTemplates;
use Amerhendy\PageManger\App\Http\Requests\PagesRequest;
class PagesAmerController extends AmerController
{
    use PageTemplates;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\ListOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\CreateOperation;
    //use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\CreateOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\UpdateOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\DeleteOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\ShowOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\TrashOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\CloneOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\BulkCloneOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\BulkDeleteOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\FetchOperation;
    use \Amerhendy\Amer\App\Http\Controllers\Base\Operations\InlineCreateOperation;
    public function setup()
    {
        AMER::setModel(Pages::class);
        AMER::setRoute(config('Amer.PageManger.route_prefix') . '/Pages');
        AMER::setEntityNameStrings(trans('PAGELANG::Pages.singular'), trans('PAGELANG::Pages.plural'));
        $this->Amer->setTitle(trans('PAGELANG::Pages.create'), 'create');
        $this->Amer->setHeading(trans('PAGELANG::Pages.create'), 'create');
        $this->Amer->setSubheading(trans('PAGELANG::Pages.create'), 'create');
        $this->Amer->setTitle(trans('PAGELANG::Pages.edit'), 'edit');
        $this->Amer->setHeading(trans('PAGELANG::Pages.edit'), 'edit');
        $this->Amer->setSubheading(trans('PAGELANG::Pages.edit'), 'edit');
        $this->Amer->addClause('where', 'deleted_at', '=', null);
		$this->setPermisssions('Pages');
    }
    public function setPermisssions($n){
        $this->Amer->enableDetailsRow ();
        $this->Amer->allowAccess ('details_row');
        $this->Amer->enableBulkActions();
        $accesslist=['update','list', 'show','trash','reorder','delete','create','clone','BulkDelete'];
        foreach ($accesslist as $l) {
            if(amer_user()->canper($n.'-'.$l) === false){$this->Amer->denyAccess($l);}
        }
    }
    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
    protected function setupListOperation(){
        AMER::addColumn([
            'name' => 'name',
            'label' => trans('PAGELANG::Pages.name'),
        ]);
        AMER::addColumn([
            'name' => 'template',
            'label' => trans('PAGELANG::Pages.template'),
            'type' => 'model_function',
            'function_name' => 'getTemplateName',
        ]);
        AMER::addColumn([
            'name' => 'slug',
            'label' => trans('PAGELANG::Pages.slug'),
        ]);
        AMER::addButtonFromModelFunction('line', 'open', 'getOpenButton', 'beginning');
    }
    protected function setupCreateOperation()
    {
        $this->addDefaultPageFields(\Request::input('template'));
        $this->useTemplate(\Request::input('template'));
        AMER::setValidation(PagesRequest::class);
    }
    protected function setupUpdateOperation()
    {
        AMER::setValidation(PagesRequest::class);
        $template = \Request::input('template') ?? AMER::getCurrentEntry()->template;

        $this->addDefaultPageFields($template);
        $this->useTemplate($template);
    }
    public function addDefaultPageFields($template = false)
    {
        AMER::addField([
            'name' => 'template',
            'label' => trans('PAGELANG::Pages.template'),
            'type' => 'select_page_template',
            'view_namespace' => 'PageManger::fields',
            'options' => $this->getTemplatesArray(),
            'value' => $template,
            'allows_null' => false,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        AMER::addField([
            'name' => 'name',
            'label' => trans('PAGELANG::Pages.page_name'),
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            // 'disabled' => 'disabled'
        ]);
        AMER::addField([
            'name' => 'title',
            'label' => trans('PAGELANG::Pages.page_title'),
            'type' => 'text',
            // 'disabled' => 'disabled'
        ]);
        AMER::addField([
            'name' => 'slug',
            'label' => trans('PAGELANG::Pages.page_slug'),
            'type' => 'text',
            'hint' => trans('PAGELANG::Pages.page_slug_hint'),
            // 'disabled' => 'disabled'
        ]);
    }
    public function useTemplate($template_name = false)
    {
        $templates = $this->getTemplates();

        // set the default template
        if ($template_name == false) {
            $template_name = $templates[0]->name;
        }
        // actually use the template
        if ($template_name) {
            $this->{$template_name}();
        }
    }
    public function getTemplates($template_name = false)
    {
        $templates_array = [];
        $templates_trait = new \ReflectionClass('Amerhendy\PageManger\App\PageTemplates');
        $templates = $templates_trait->getMethods(\ReflectionMethod::IS_PRIVATE);

        if (! count($templates)) {
            abort(503, trans('PAGELANG::Pages.template_not_found'));
        }

        return $templates;
    }
    public function getTemplatesArray()
    {
        $templates = $this->getTemplates();

        foreach ($templates as $template) {
            $templates_array[$template->name] = str_replace('_', ' ', \Str::title($template->name));
        }

        return $templates_array;
    }
    public function destroy($id)
    {
        $this->Amer->hasAccessOrFail('delete');
        $data=$this->Amer->model::remove_force($id);
        return $data;
    }
}
