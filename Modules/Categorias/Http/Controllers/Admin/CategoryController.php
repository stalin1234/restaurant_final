<?php

namespace Modules\Categorias\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Categorias\Entities\Category;
use Modules\Categorias\Http\Requests\CreateCategoryRequest;
use Modules\Categorias\Http\Requests\UpdateCategoryRequest;
use Modules\Categorias\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;


class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$categories = $this->category->all();

        return view('categorias::admin.categories.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categorias= Category::get();
        return view('categorias::admin.categories.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->category->create($request->all());

        return redirect()->route('admin.categorias.category.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('categorias::categories.title.categories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('categorias::admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  UpdateCategoryRequest $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        return redirect()->route('admin.categorias.category.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('categorias::categories.title.categories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $this->category->destroy($category);

        return redirect()->route('admin.categorias.category.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('categorias::categories.title.categories')]));
    }



    public function paginate( Request $request){

        $datos = [
            "data" => [],
            "recordsTotal" => 0,
            "recordsFiltered" => 0
        ];

       $columnas = [
        
            "nombrecategoria",
            "created_at"
        ];

      dd( $request->all() );

        $ordenColumna = ( $request->has("order") ? $request->get("order")[0]["column"] : 0 );
        $ordenDir = ( $request->has("order") ? $request->get("order")[0]["dir"] : "ASC" );

        $Category = Category::buscar( ( $request->has('search') ? $request->get('search')["value"] : false ) )
            ->skip( ( $request->has("start") ? $request->get("start") : 0 ))
            ->take( ( $request->has("length") ? $request->get("length") : 10 ) )
            ->orderBy( $columnas[ $ordenColumna ], $ordenDir )
            ->get();
            // dd($CategoriaPaquetePrestacion);
        if( $Category ){
            $Category
                ->each( function( $Category ){

                    $Category->accion = '<div class="btn-group">' .
                        '<a href="' . route('admin.categorias.category.edit', [
                         $Category->idcategoria
                     ] ) . '" class="btn btn-default btn-flat">' .
                            '<i class="fa fa-pencil"></i>' .
                        '</a>' .
                        '<button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="' . route('admin.categorias.category.destroy', [$Category->idcategoria]) . '">' .
                            '<i class="fa fa-trash"></i>' .
                        '</button>' .
                    '</div>';

                    return $Category;
                });
        }

        $datos["recordsFiltered"] = Category::buscar( ( $request->has('search') ? $request->get('search')["value"] : false ) )->count();
        $datos["data"] = ( $Category ? $Category->toArray() : [] );
        $datos["recordsTotal"] = count($datos["data"]);

        return response()
            ->json( $datos , 200 );
    }


}
