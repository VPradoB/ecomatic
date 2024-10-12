<?php
class Machine
{

	public function __construct()
	{

	}

	/**
	 * @api {get} /api/machine Listar
	 * @apiVersion 0.1.0
	 * @apiName IndexMachine
	 * @apiGroup Machine
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} mac codigo alternativo
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} ubication ubicacion actual
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * @apiSuccess {Date}	fecha de eliminación en caso de borrado
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 * [
	 * 	{
     *   	"id": 1,
     *   	"mac": "#001",
     *   	"name": "foo",
     *   	"ubication": "bar",
     *   	"created_at": "2018-02-15 15:11:28",
     *   	"updated_at": "2018-02-15 15:11:28",
     *   	"deleted_at": null
	 *	},
	 *	{     
	 *   	"id": 2,
     *   	"mac": "#002",
     *   	"name": "foo2",
     *   	"ubication": "bar2",
     *   	"created_at": "2018-02-16 15:11:28",
     *   	"updated_at": "2018-02-16 15:11:28",
     *   	"deleted_at": "2018-02-17 15:11:28"
	 *	}
	 *]
	 */
	public function index()
	{

	}

	/**
	 * @api {get} /api/machine/:id Mostrar
	* @apiVersion 0.1.0
	 * @apiName GetMachine
	 * @apiGroup Machine
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} mac codigo alternativo
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} ubication ubicacion actual
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * @apiSuccess {Date}	deleted_at fecha de eliminación en caso de borrado
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *	{     
	 *   	"id": 2,
     *   	"mac": "#002",
     *   	"name": "foo2",
     *   	"ubication": "bar2",
     *   	"created_at": "2018-02-16 15:11:28",
     *   	"updated_at": "2018-02-16 15:11:28",
     *   	"deleted_at": "2018-02-17 15:11:28"
	 *	}
	 *
	 * @apiError MachineNotFound The id of the User was not found.
	 *
	 * @apiErrorExample ErrorResponse:
	 *  HTTP/1.1 404 MachineNotFound
   *{
   *  "error": "No query results for model [App\\Machine]."
   *}
	 */
	public function show()
	{

	}


	/**
	 * @api {post} /api/machine Crear
	* @apiVersion 0.1.0
	 * @apiName PostMachine
	 * @apiGroup Machine
	 * 
	 * @apiParam {String} mac codigo alternativo
	 * @apiParam {String} name nombre
	 * @apiParam {String} ubication ubicacion actual
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} mac codigo alternativo
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} ubication ubicacion actual
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * @apiSuccess {Date}	deleted_at fecha de eliminación en caso de borrado
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *	{     
	 *   	"id": 2,
   *   	"mac": "#002",
   *   	"name": "foo2",
   *   	"ubication": "bar2",
   *   	"created_at": "2018-02-16 15:11:28",
   *   	"updated_at": "2018-02-16 15:11:28",
   *   	"deleted_at": "2018-02-17 15:11:28"
	 *	}
	 *
	 * 
	 * @apiError mac_required MAC requerido
	 * @apiError mac_string MAC no es un texto
	 * @apiError mac_max MAC excedio el tamaño maximo (254 caracteres)
	 * 
	 * @apiError name_required nombre requerido
   * @apiError  name_string nombre no es un texto
	 * @apiError name_max nombre excedio el tamaño maximo (254 caracteres)
	 * 
	 * @apiError ubication_required ubiacion requerida
	 * @apiError ubication_string ubicacion no es un texto
	 * @apiError ubiation_max ubicación excedio el tamaño maximo (254 caracteres)
	 * 
	 *
	 * @apiErrorExample BadRequest:
	 *     HTTP/1.1 400	Bad Request
	 *{
	 *  "mac": 
	 *  [
   *    "MAC duplicado"
	 *  ]
	 *  "name": 
   *  [
	 *  "nombre requerido"
	 *  ]
	 *}
	 */
	public function store()
	{

	}

	/**
	 * @api {put} /api/machine/:id Actualizar
	 * @apiVersion 0.1.0
	 * @apiName PutMachine
	 * @apiGroup Machine
	 *
	 * @apiParam {Number} id identificador de la maquina
	 * @apiParam {String} mac codigo alternativo a modificar
	 * @apiParam {String} name nombre a modificar
	 * @apiParam {String} ubication ubicacion actual a modificar
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *	{     
	 *   	"id": :id,
     *   	"mac": "#006",
     *   	"name": "foo2",
     *   	"ubication": "bar2",
     *   	"created_at": "2018-02-16 15:11:28",
     *   	"updated_at": "2018-02-16 15:11:28",
     *   	"deleted_at": "2018-02-17 15:11:28"
	 *	}
	 *
	 * @apiError MachineNotFound el id de la maquina no existe
	 * @apiError mac_unique MAC duplicado
	 * @apiError mac_string MAC no es un texto
	 * @apiError mac_max MAC excedio el tamaño maximo (254 caracteres)
	 * 
     * @apiError  name_string nombre no es un texto
	 * @apiError name_max nombre excedio el tamaño maximo (254 caracteres)
	 * 
	 * @apiError ubication_string ubicacion no es un texto
	 * @apiError ubiation_max ubicación excedio el tamaño maximo (254 caracteres)
	 * 
	 * 
	 * @apiErrorExample ErrorResponse:
	 *  HTTP/1.1 404 MachineNotFound
   *{
   *  "error": "No query results for model [App\\Machine]."
   *}
	 * 
	 * @apiErrorExample Error-BaD-Request:
	 *     HTTP/1.1 400 Bad Request
	 *{
     *	"mac": [
     *   	"MAC duplicado "
	 *	]
	 *	"name: [
	 *		"nombre excedio el tamaño maximo(254 caracteres)"
	 *  ]
	 *}
	 */
	public function update()
	{

	}

	/**
	 * @api {delete} /api/machine/:id Eliminar
	 * @apiVersion 0.1.0
	 * @apiName DeleteMachine
	 * @apiGroup Machine
	 *
	 * @apiParam {Number} id Identificador unicode de la maquina
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "true"
	 *     }
	 *
	 * @apiError MachineNotFound no se encuentra la maquina
	 *
	 * @apiErrorExample ErrorResponse:
	 *  HTTP/1.1 404 MachineNotFound
   *{
   *  "error": "No query results for model [App\\Machine]."
   *}
	 */
	public function delete()
	{

	}

	/**
    * @api {get} /api/machine/:id/tanks Listar cilindros
	* @apiVersion 0.1.0
	* @apiName getTanks
	* @apiGroup Machine
	*
	* @apiParam {Number} id Identificador unicode de la maquina
	* @apiSuccessExample Success-Response:
	*     HTTP/1.1 200 OK
	*[
	*    {
    *	    "id": 1,
    *	    "machine_id": 4,
    *	    "product_values": "0",
    *	    "product_id": 3,
    *	    "min_product_values": 0,
    *	    "status": 1,
    *	    "alert": 1,
    *	    "created_at": "2018-02-16 00:34:38",
    *	    "updated_at": "2018-02-16 00:34:38",
    *    	"deleted_at": null
    *	},
    *	{
    *	    "id": 2,
    *	    "machine_id": 4,
    *	    "product_values": "0",
    *	    "product_id": 3,
    *	    "min_product_values": 0,
    *	    "status": 1,
    *	    "alert": 1,
    *	    "created_at": "2018-02-16 00:34:43",
    *	    "updated_at": "2018-02-16 00:34:43",
    *	    "deleted_at": null
	*	}
	*]
	* @apiError MachineNotFound The id of the User was not found.
	*
	 * @apiErrorExample ErrorResponse:
	 *  HTTP/1.1 404 MachineNotFound
   *{
   *  "error": "No query results for model [App\\Machine]."
   *}
	*/
	public function tanks()
	{

	}
}