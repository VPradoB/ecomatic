<?php
class Company
{

	public function __construct()
	{

	}

	/**
	 * @api {get} /api/company Listar
	 * @apiVersion 0.1.0
	 * @apiName IndexCompany
	 * @apiGroup Company
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} direction dirección de compañia
	 * @apiSuccess {String} phone_number número telefonico
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *[
	 *  {
   *    "id": 1,
   *    "name": "Google",
   *    "direction": "Sillicon Valley",
	 *    "phone_number": "(0500) 005-0055",
   *    "created_at": "2018-02-15 15:11:28",
   *    "updated_at": "2018-02-15 15:11:28"
	 *  },
	 *  {     
	 *    "id": 2,
   *    "name": "foo2",
   *    "direction": "bar2",
	 *    "phone_number": "(0800) 123-4567",
   *    "created_at": "2018-02-16 15:11:28",
   *    "updated_at": "2018-02-16 15:11:28"
	 *  }
	 *]
	 */
	public function index()
	{

	}

	/**
	 * @api {get} /api/company/:id Mostrar
	* @apiVersion 0.1.0
	 * @apiName GetCompany
	 * @apiGroup Company
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} direction dirección de compañia
	 * @apiSuccess {String} phone_number número telefonico
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *  HTTP/1.1 200 OK
	 *{     
	 *  "id": 2,
   *  "name": "foo2",
   *  "direction": "bar2",
	 *  "phone_number": "(0800) 123-4567",
   *  "created_at": "2018-02-16 15:11:28",
   *  "updated_at": "2018-02-16 15:11:28"
	 *}
	 *
	 * @apiError CompanyNotFound The id of the Company was not found.
	 *
	 * @apiErrorExample Error-CompanyNotFound:
	 *     HTTP/1.1 404 CompanyNotFound
	 *{
   *  "error": "No query results for model [App\\Company]."
	 *}
	 */
	public function show()
	{

	}


	/**
	 * @api {post} /api/company Crear
	* @apiVersion 0.1.0
	 * @apiName PostCompany
	 * @apiGroup Company
	 * 
	 * @apiParam {String} name nombre
	 * @apiParam {String} direction dirección de compañia
	 * @apiParam {String} phone_number número telefonico
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} direction dirección de compañia
	 * @apiSuccess {String} phone_number número telefonico
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *  HTTP/1.1 200 OK
	 *{
   *  "id": 1,
   *  "name": "Google",
   *  "direction": "Sillicon Valley",
	 *  "phone_number": "(0500) 005-0055",
   *  "created_at": "2018-02-15 15:11:28",
   *  "updated_at": "2018-02-15 15:11:28"
	 *}
	 *
	 * 
   * @apiError name_string El nombre de la compañia debe ser un texto
   * @apiError name_max El nombre de la compañia ha excedido el tamaño maximo (100 caracteres)
   * @apiError name_required Se requiere un nombre para la compañia
	 * 
   * @apiError direction_string La direción de la compañia debe ser un texto
   * @apiError direction_max La dirección de la compañia ha excedido el tamaño maximo (100 caracteres)
   * @apiError direction_required Se requiere una dirección para la compañia
	 * 
   * @apiError phone_number_string El número de teléfono de la compañia debe ser un texto
   * @apiError phone_number_max El número de teléfono de la compañia ha excedido el tamaño maximo (100 caracteres)
   * @apiError phone_number_required El número de teléfono de la compañia
	 * 
	 *
	 * @apiErrorExample Bad-Request:
	 *     HTTP/1.1 400	Bad Request
	 *{
	 *  "name": 
   *  [
	 *    "Se requiere un nombre para la compañia"
	 *  ],
	 *  "direction": 
   *  [
	 *    "Se requiere una dirección para la compañia"
	 *  ]
	 *}
	*/
	public function store()
	{

	}

	/**
	 * @api {put} /api/company/:id Actualizar
	 * @apiVersion 0.1.0
	 * @apiName PutCompany
	 * @apiGroup Company
	 *
	 * @apiParam {Number} id identificador de la compañia
	 * @apiParam {String} name nombre
	 * @apiParam {String} direction dirección de compañia
	 * @apiParam {String} phone_number número telefonico
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *	HTTP/1.1 200 OK
	 *{
   *  "id": 1,
   *  "name": "Google",
   *  "direction": "Sillicon Valley",
	 *  "phone_number": "(0500) 005-0055",
   *  "created_at": "2018-02-15 15:11:28",
   *  "updated_at": "2018-02-15 15:11:28"
	 *}
	 *
	 * @apiError id_NotFound no se ha encontrado la compañia 404
	 * 
   * @apiError name_string El nombre de la compañia debe ser un texto
   * @apiError name_max El nombre de la compañia ha excedido el tamaño maximo (100 caracteres)
	 * 
   * @apiError direction_string La direción de la compañia debe ser un texto
   * @apiError direction_max La dirección de la compañia ha excedido el tamaño maximo (100 caracteres)
	 * 
   * @apiError phone_number_string El número de teléfono de la compañia debe ser un texto
   * @apiError phone_number_max El número de teléfono de la compañia ha excedido el tamaño maximo (100 caracteres)
	 * 
	 * 
	 * 
	 * @apiErrorExample Error-CompanyNotFound:
	 *     HTTP/1.1 404 CompanyNotFound
	 *{
   *  "error": "No query results for model [App\\Company]."
	 *}
	 * 
	 * @apiErrorExample Error-BadRequest:
	 *     HTTP/1.1 400 Bad Request
	 *{
	 *  "name": 
   *  [
	 *    "Se el nombre de la compañia no es un texto"
	 *  ],
	 *  "direction": 
   *  [
	 *    "La dirección de la compañia ha excedido el tamaño maximo (100 caracteres)"
	 *  ]
	 *}
	*/
	public function update()
	{

	}

	/**
	 * @api {delete} /api/company/:id Eliminar
	 * @apiVersion 0.1.0
	 * @apiName DeleteCompany
	 * @apiGroup Company
	 *
	 * @apiParam {Number} id Identificador unicode de la compañia
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "true"
	 *     }
	 *
	 * @apiErrorExample CompanyNotFound no se encuentra la compañia.
	 *
	 *     HTTP/1.1 404 CompanyNotFound
	 *{
   *  "error": "No query results for model [App\\Company]."
	 *}
	 */
	public function delete()
	{

	}
}