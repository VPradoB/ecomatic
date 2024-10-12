<?php

class Publicity
{
  public function __construct()
	{

	}

	/**
	 * @api {get} /api/publicity Listar
	 * @apiVersion 0.1.0
	 * @apiName IndexPublicity
	 * @apiGroup Publicity
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} description descripcion de la publicidad
	 * @apiSuccess {interger} company_id identificador de la compañia que hizo la publicidad
   * @apiSuccess {string} logo  nombre de logo en storage/img
   * @apiSuccess {string} vid nombre de video en storage/img
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
[
    {
        "id": 1,
        "name": "Principal",
        "description": "not defined",
        "company_id": 1,
        "vid": "sample video.mp4",
        "logo": "sample image.jpg",
        "created_at": "2018-02-17 10:24:45",
        "updated_at": "2018-02-17 10:24:45"
    }
]
	 */
	public function index()
	{

	}

	/**
	 * @api {get} /api/publicity/:id Mostrar
	* @apiVersion 0.1.0
	 * @apiName GetPublicty
	 * @apiGroup Publicity
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} description descripcion de la publicidad
	 * @apiSuccess {interger} company_id identificador de la compañia que hizo la publicidad
   * @apiSuccess {string} logo nombre de logo en /storage/img
   * @apiSuccess {string} vid nombre de video en /storage/img
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *  HTTP/1.1 200 OK
    {
        "id": 1,
        "name": "Principal",
        "description": "not defined",
        "company_id": 1,
        "vid": "sample video.mp4",
        "logo": "sample image.jpg",
        "created_at": "2018-02-17 10:24:45",
        "updated_at": "2018-02-17 10:24:45"
    }
	 *
	 * @apiError PublicityNotFound The id of the Publicty was not found.
	 *
	 * @apiErrorExample Error-PublicityNotFound:
	 *     HTTP/1.1 404 PublicityNotFound
	 *{
   *  "error": "No query results for model [App\\Publicity]."
	 *}
	 */
	public function show()
	{

	}


	/**
	 * @api {post} /api/publicity Crear
	* @apiVersion 0.1.0
	 * @apiName PostPublicity
	 * @apiGroup Publicity  
	 * 
	 * @apiParam {String} name nombre
	 * @apiParam {String} description descripcion de la publicidad
	 * @apiParam {interger} company_id identificador de la compañia que hizo la publicidad
   * @apiParam {string} logo nombre de logo en /storage/img
   * @apiParam {string} vid nombre de video en /storage/img
	 *
	 *
	 * @apiSuccess {Number} id  identificador
	 * @apiSuccess {String} name nombre
	 * @apiSuccess {String} description descripcion de la publicidad
	 * @apiSuccess {interger} company_id identificador de la compañia que hizo la publicidad
   * @apiSuccess {string} logo nombre de logo en /storage/img
   * @apiSuccess {string} vid nombre de video en /storage/img
	 * @apiSuccess {Date}	created_at fecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *  HTTP/1.1 200 OK
    {
        "id": 1,
        "name": "Principal",
        "description": "not defined",
        "company_id": 1,
        "vid": "sample video.mp4",
        "logo": "sample image.jpg",
        "created_at": "2018-02-17 10:24:45",
        "updated_at": "2018-02-17 10:24:45"
    }
	 *
	 * 
    @apiError description_string        La descripción debe ser un texto
    @apiError description_required      La descripción es requerida
    @apiError name_string               el nombre debe ser un texto
    @apiError name_required             El nombre se requiere
    @apiError company_id_integer        Esa compañia no existe, recargue la página
    @apiError company_id_required       Se requiere una compañia
    @apiError logo_file                 El logo debe ser una imagen
    @apiError logo_required             El logo es necesario
    @apiError logo_image                El logo debe ser una imagen
    @apiError logo_image                nombre de logo existente
    @apiError vid_file                  El video debe ser de tipo mp4, ogg o webm
    @apiError vid_mimes                 El video debe ser de tipo mp4, ogg o webm
    @apiError vid_required              El video es necesario
    @apiError vid_duplicated            nombre de video existente
	 * 
	 *
	 * @apiErrorExample Bad-Request:
	 *     HTTP/1.1 400	Bad Request
	 *{
	 *  "name": 
   *  [
	 *    "El nombre se requiere"
	 *  ],
	 *  "vid": 
   *  [
	 *    "El video es necesario"
	 *  ]
	 *}
	*/
	public function store()
	{

	}

	/**
	 * @api {put} /api/publicity/:id Actualizar
	 * @apiVersion 0.1.0
	 * @apiName PutPublicity
	 * @apiGroup Publicity
	 *
   * 
	 * @apiParam {Number} :id  identificador
	 * @apiParam {String} name nombre
	 * @apiParam {String} description descripcion de la publicidad
	 * @apiParam {interger} company_id identificador de la compañia que hizo la publicidad
   * @apiParam {string} logo nombre de logo para guardar en /storage/img
   * @apiParam {string} vid nombre de video para guardar en /storage/img
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *	HTTP/1.1 200 OK
    {
        "id": 1,
        "name": "Principal",
        "description": "not defined",
        "company_id": 1,
        "vid": "sample video.mp4",
        "logo": "sample image.jpg",
        "created_at": "2018-02-17 10:24:45",
        "updated_at": "2018-02-17 10:24:45"
    }
	 *
    @apiError description_string        La descripción debe ser un texto
    @apiError description_required      La descripción es requerida
    @apiError name_string               el nombre debe ser un texto
    @apiError name_required             El nombre se requiere
    @apiError company_id_integer        Esa compañia no existe, recargue la página
    @apiError company_id_required       Se requiere una compañia
    @apiError logo_file                 El logo debe ser una imagen
    @apiError logo_required             El logo es necesario
    @apiError logo_image                El logo debe ser una imagen
    @apiError logo_image                nombre de logo existente
    @apiError vid_file                  El video debe ser de tipo mp4, ogg o webm
    @apiError vid_mimes                 El video debe ser de tipo mp4, ogg o webm
    @apiError vid_required              El video es necesario
    @apiError vid_duplicated            nombre de video existente
	 * 
	 * 
	 * 
	 * @apiErrorExample Error-PublicityNotFound:
	 *     HTTP/1.1 404 PublicityNotFound
	 *{
   *  "error": "No query results for model [App\\Publicity]."
	 *}
	 * 
	 * @apiErrorExample Error-BadRequest:
	 *     HTTP/1.1 400 Bad Request
	 *{
	 *  "name": 
   *  [
	 *    "El nombre se requiere"
	 *  ]
	 *}
	*/
	public function update()
	{

	}

	/**
	 * @api {delete} /api/publicity/:id Eliminar
	 * @apiVersion 0.1.0
	 * @apiName DeletePublicity
	 * @apiGroup Publicity
	 *
	 * @apiParam {Number} id Identificador unico de de la publicidad
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "true"
	 *     }
	 *
	 * @apiErrorExample PublicityNotFound no se encuentra la publicidad.
	 *
	 *     HTTP/1.1 404 PublicidadNotFound
	 *{
   *  "error": "No query results for model [App\\Publicity]."
	 *}
	 */
	public function delete()
	{

	}
}