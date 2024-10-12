<?php

use Illuminate\Support\Facades\Storage;

class Product
{

	public function __construct()
	{

	}

	/**
	 * @api {get} /api/product Listar
	 * @apiVersion 0.1.0
	 * @apiName IndexProduct
	 * @apiGroup Product
	 *
	 *
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {interger} price precio
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * @apiSuccess {Date}	fecha de eliminación en caso de borrado
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *[
     *	{
     *	    "id": 3,
     *	    "name": "Principal",
     *	   "price": 50000,
     *	    "created_at": "2018-02-15 13:56:10",
     *	    "updated_at": "2018-02-15 13:56:10",
     *	    "deleted_at": null
     *	},
     *	{
     *	    "id": 4,
     *	    "name": "Non qui.",
     *	    "price": 5880,
     *	    "created_at": "2018-02-15 22:49:36",
     *	    "updated_at": "2018-02-15 22:49:36",
     *	    "deleted_at": null
     *	}
	 *]
	 */
	public function index()
	{

	}

	/**
	 * @api {get} /api/product/:id Mostrar
	* @apiVersion 0.1.0
	 * @apiName GetProduct
	 * @apiGroup Product
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {interger} price precio
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * @apiSuccess {Date}	deleted_at fecha de eliminación en caso de borrado
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *	{
     *	    "id": 4,
     *	    "name": "Non qui.",
     *	    "price": 5880,
     *	    "created_at": "2018-02-15 22:49:36",
     *	    "updated_at": "2018-02-15 22:49:36",
     *	    "deleted_at": null
     *	}
	 *
	 * @apiError ProductNotFound no se pudo encontrar el producto
	 *
	 * @apiErrorExample ProductNotFound:
	 *     HTTP/1.1 404 Bad Response
	 * {
	 *	"error": "No query results for model [App\\Product]."
	 * }
	 */
	public function show()
	{

	}


	/**
	 * @api {post} /api/product Crear
	* @apiVersion 0.1.0
	 * @apiName PostProduct
	 * @apiGroup Product
	 * 
	 * @apiParam {String} name nombre a modificar
	 * @apiParam {interger} precio del producto
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *	{
     *	    "id": 4,
     *	    "name": "Non qui.",
     *	    "price": 5880,
     *	    "created_at": "2018-02-15 22:49:36",
     *	    "updated_at": "2018-02-15 22:49:36",
     *	    "deleted_at": null
     *	}
	 *
	 * @apiError ProductNotFound el id del producto no existe.
	 * 
	 * @apiError name_required El nombre de producto es necesario
	 * @apiError name_string El nombre debe ser un texto
     * @apiError name_max Nombre debe tener maximo 100 caracteres
	 * 
     * @apiError price_required Se necesita un precio para el producto
     * @apiError price_min El precio no puede ser negativo
     * @apiError price_integer 'El precio debe ser un número entero
	 * 
	 * 
	 * @apiErrorExample ProductNotFound:
	 *     HTTP/1.1 404 Bad Response
	 * {
	 *	"error": "No query results for model [App\\Product]."
	 * }
	 * 
	 * @apiErrorExample Error-BadRequest:
	 *     HTTP/1.1 400 Bad Request
	 *{
	 *	"price": 
	 *	[
     *		"el precio debe ser un número entero"
	 *	]
	 *	"name": 
	 *	[
	 *		"nombre excedio el tamaño maximo(254 caracteres)"
	 *	]
	 *}
	 */
	public function store()
	{

	}

	/**
	 * @api {put} /api/machine/:id Actualizar
	 * @apiVersion 0.1.0
	 * @apiName PutProduct
	 * @apiGroup Product
	  * 
	 * @apiParam {String} name nombre a modificar
	 * @apiParam {interger} precio del producto
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *	{
     *	    "id": 4,
     *	    "name": "Non qui.",
     *	    "price": 5880,
     *	    "created_at": "2018-02-15 22:49:36",
     *	    "updated_at": "2018-02-15 22:49:36",
     *	    "deleted_at": null
     *	}
	 *
	 * @apiError ProductNotFound el id del producto no existe, error 500.
	 * 
	 * @apiError name_required El nombre de producto es necesario
	 * @apiError name_string El nombre debe ser un texto
     * @apiError name_max Nombre debe tener maximo 100 caracteres
	 * 
     * @apiError price_required Se necesita un precio para el producto
     * @apiError price_min El precio no puede ser negativo
     * @apiError price_integer 'El precio debe ser un número entero
	 * 
	 * 
	 * @apiErrorExample ProductNotFound:
	 *     HTTP/1.1 404 Bad Response
	 * {
	 *	"error": "No query results for model [App\\Product]."
	 * }
	 * 
	 * @apiErrorExample Error-BadRequest:
	 *     HTTP/1.1 400 Bad Request
	 *{
	 *	"price": 
	 *	[
     *		"el precio debe ser un número entero"
	 *	]
	 *	"name": 
	 *	[
	 *		"nombre excedio el tamaño maximo(254 caracteres)"
	 *	]
	 *}
	 */
	public function update()
	{

	}

	/**
	 * @api {delete} /api/product/:id Eliminar
	 * @apiVersion 0.1.0
	 * @apiName DeleteProduct
	 * @apiGroup Product
	 *
	 * @apiParam {Number} id Identificador unicode del producto
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "true"
	 *     }
	 *
	 * @apiError ProductNotFound no se encuentra el producto.
	 *
	 * @apiErrorExample ProductNotFound:
	 *     HTTP/1.1 404 Bad Response
	 * {
	 *	"error": "No query results for model [App\\Product]."
	 * }
	 */
	public function delete()
	{
        Storage::delete($this->logo);
        return parent::delete();
	}
}