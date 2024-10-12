<?php
class Configuration
{

	public function __construct()
	{

	}

	/**
	 * @api {get} /api/configuration Listar
	 * @apiVersion 0.1.0
	 * @apiName IndexConfiguration
	 * @apiGroup Configuration
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {interger} value valor de la configuración
	 * @apiSuccess {String} description descripción
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 * [
	 *  {
   *    "id": 1,
   *    "name": "frecuencia de alerta",
   *    "value": "120",
	 *    "description": "cantidad de tiempo entre reporte de maquinas"
   *    "created_at": "2018-02-15 15:11:28",
   *    "updated_at": "2018-02-15 15:11:28",
	 * },
	 * {     
	 *    "id": 2,
   *    "name": "foo",
   *    "value": "2",
	 *    "description": "some description"
   *    "created_at": "2018-02-16 15:11:28",
   *    "updated_at": "2018-02-16 15:11:28",
	 *  }
	 *]
	 */
	public function index()
	{

	}

	/**
	 * @api {get} /api/configurationy/:id Mostrar
	 * @apiVersion 0.1.0
	 * @apiName GetConfiguration
	 * @apiGroup Configuration
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {interger} value valor de la configuración
	 * @apiSuccess {String} description descripción
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificacións
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *  HTTP/1.1 200 OK
	 *{
   *  "id": 1,
   *  "name": "frecuencia de alerta",
   *  "value": "120",
	 *  "description": "cantidad de tiempo entre reporte de maquinas"
   *  "created_at": "2018-02-15 15:11:28",
   *  "updated_at": "2018-02-15 15:11:28"
	 *}
	 *
	 * @apiError ConfigurationNotFound The id of the Configuration was not found.
	 *
	 * @apiErrorExample Error-ConfigurationNotFound:
	 *     HTTP/1.1 404 ConfigurationNotFound
	 * {
	 *    "error": "No query results for model [App\\Configuration]."
	 * }
	 */
	public function show()
	{

	}


	/**
	 * @api {post} /api/configuration Crear
	 * @apiVersion 0.1.0
	 * @apiName PostConfiguration
	 * @apiGroup Configuration
	 * 
	 * @apiParam {String} name nombre
	 * @apiParam {interger} value valor de la configuración
	 * @apiParam {String} description descripción
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {interger} value valor de la configuración
	 * @apiSuccess {String} description descripción
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *  HTTP/1.1 200 OK
	 *{
   *  "id": 1,
   *  "name": "frecuencia de alerta",
   *  "value": "120",
	 *  "description": "cantidad de tiempo entre reporte de maquinas",
   *  "created_at": "2018-02-15 15:11:28",
   *  "updated_at": "2018-02-15 15:11:28"
	 *}
	 *
	 * @apiError code_unique El codigo de la configuración debe ser unico
   * @apiError code_required Se requiere un codigo
   * @apiError code_max El codigo excede debe ser de 5 caracteres o menos
	 * 
   * @apiError value_integer El valor debe ser entero
   * @apiError value_required Se requiere un valor
	 * 
   * @apiError description_string La descripción excede tamaño maximo (240 caracteres)
   * @apiError description_required Se requiere una descripción
	 * 
	 *
	 * @apiErrorExample Bad-Request:
	 *     HTTP/1.1 400	BadRequest
	 *{
	 *  "code": 
   *  [
	 *    "El codigo excede debe ser de 5 caracteres o menos"
	 *  ],
	 *  "value": 
   *  [
	 *    "Se requiere un valor"
	 *  ]
	 *}
	 */
	public function store()
	{

	}

	/**
	 * @api {put} /api/configuration/:id Actualizar
	 * @apiVersion 0.1.0
	 * @apiName PutConfiguration
	 * @apiGroup Configuration
	 *
	 * @apiParam {Number} id identificador de la cofiguracion
	 * @apiParam {String} name nombre
	 * @apiParam {interger} value valor de la configuración
	 * @apiParam {String} description descripción de la configuración
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *{
     *	"id": :id,
     *	"name": "frecuencia de alerta",
     *	"value": "120",
	 *	"description": "cantidad de tiempo entre reporte de maquinas",
     *	"created_at": "2018-02-15 15:11:28",
     *	"updated_at": "2018-02-15 15:11:28",
	 *}
	 *
	 * @apiError id_NotFound error 404 configurationNotFound
	 * 
	 * @apiError code_unique El codigo de la configuración debe ser unico
     * @apiError code_max El codigo excede debe ser de 5 caracteres o menos
	 * 
     * @apiError value_integer El valor debe ser entero
	 * 
     * @apiError description_string La descripción excede tamaño maximo (240 caracteres)
	 * 
	 * 
	 * 
	 * @apiErrorExample Error-ConfigurationNotFound:
	 *     HTTP/1.1 404 Bad Response
	 *{
	 *  "error": "No query results for model [App\\Configuration]."
	 *}
	 * 
	 * @apiErrorExample Error-BadRequest:
	 *     HTTP/1.1 400 Bad Request
	 *{
	 *  "code": 
	 *  [
	 *    "El codigo excede debe ser de 5 caracteres o menos"
	 *  ],
	 *  "value": 
	 *  [
	 *    "El valor debe ser entero"
	 *  ]
	 *}
	 */
	public function update()
	{

	}

	/**
	 * @api {delete} /api/configuration/:id Eliminar
	 * @apiVersion 0.1.0
	 * @apiName DeleteConfiguration
	 * @apiGroup Configuration
	 *
	 * @apiParam {Number} id Identificador unico de de la configuración
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "true"
	 *     }
	 *
	 * @apiError ConfigurationNotFound no se encuentra la maquina error 404.
	 *
	 * @apiErrorExample ConfigurationNotFound:
	 *  HTTP/1.1 404
	 *  {
	 *      "error": "No query results for model [App\\Configuration]."
	 *  }
	 */
	public function delete()
	{

	}

}