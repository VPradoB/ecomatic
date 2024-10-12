<?php
class Tank
{

	public function __construct()
	{

	}

	/**
	 * @api {get} /api/Tank Listar
	 * @apiVersion 0.1.0
	 * @apiName IndexTank
	 * @apiGroup Tank
	 *
	 *
	 * @apiSuccess {Number} id  identificador del cilindro
	 * @apiSuccess {interger} machine_id identificador de la maquina a la que pertenece
	 * @apiSuccess {interger} product_id identificador del producto que contiene
	 * @apiSuccess {interger} product_values cantidad de productos en el cilindro
	 * @apiSuccess {interger} min_product_values cantidad minima de productos tolerable
	 * @apiSuccess {boolean}  status 1: cilindro activo 0: cilindro inactivo
	 * @apiSuccess {boolean}  alert 1: alertas activadas 0: alertas desactivadas
	 * @apiSuccess {Date}	created_ atfecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *[
     *	{
     *   "id": 1,
     *   "machine_id": 4,
     *   "product_values": "0",
     *   "product_id": 3,
     *   "min_product_values": 0,
     *   "status": 1,
     *   "alert": 1,
     *   "created_at": "2018-02-16 00:34:38",
     *   "updated_at": "2018-02-16 00:34:38"
     *	},
     *	{
     *   "id": 2,
     *   "machine_id": 4,
     *   "product_values": "0",
     *   "product_id": 3,
     *   "min_product_values": 0,
     *   "status": 1,
     *   "alert": 1,
     *   "created_at": "2018-02-16 00:34:43",
     *   "updated_at": "2018-02-16 00:34:43"
     *	}
	*]
	 */
	public function index()
	{

	}

	/**
	 * @api {get} api/tank/:id Mostrar
	* @apiVersion 0.1.0
	 * @apiName GetTank
	 * @apiGroup Tank
	 *
	 *
	 * @apiSuccess {Number} id  identificador del cilindro
	 * @apiSuccess {interger} machine_id identificador de la maquina a la que pertenece
	 * @apiSuccess {interger} product_id identificador del producto que contiene
	 * @apiSuccess {interger} product_values cantidad de productos en el cilindro
	 * @apiSuccess {interger} min_product_values cantidad minima de productos tolerable
	 * @apiSuccess {boolean}  status 1: cilindro activo 0: cilindro inactivo
	 * @apiSuccess {boolean}  alert 1: alertas activadas 0: alertas desactivadas
	 * @apiSuccess {Date}	created_ atfecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
     *	{
     *   "id": 1,
     *   "machine_id": 4,
     *   "product_values": "0",
     *   "product_id": 3,
     *   "min_product_values": 0,
     *   "status": 1,
     *   "alert": 1,
     *   "created_at": "2018-02-16 00:34:38",
     *   "updated_at": "2018-02-16 00:34:38"
     *	}
	 *
	 * @apiError TankNotFound The id of the User was not found.
	 *
	 * @apiErrorExample Error-TankNotFoun:
	 *     HTTP/1.1 404 Not found
	 *{
	 *  "error": "No query results for model [App\\Tank]."
	 *}
	 */
	public function show()
	{

	}


	/**
	 * @api {post} /api/tank Crear
	* @apiVersion 0.1.0
	 * @apiName PostTank
	 * @apiGroup Tank
	 * 
	 * @apiParam {interger} machine_id identificador de la maquina a la que pertenece
	 * @apiParam {interger} product_id identificador del producto que contiene
	 * @apiParam {interger} product_values cantidad de productos en el cilindro
	 * @apiParam {interger} min_product_values cantidad minima de productos tolerable
	 * @apiParam {boolean}  status 1: cilindro activo 0: cilindro inactivo
	 * @apiParam {boolean}  alert 1: alertas activadas 0: alertas desactivadas
	 * @apiParam {Date}	created_ atfecha de creación
	 * @apiParam {Date}	updated_at fecha de ultima modificación
	 *
	 *
	 * @apiSuccess {Number} id  identificador del cilindro
	 * @apiSuccess {interger} machine_id identificador de la maquina a la que pertenece
	 * @apiSuccess {interger} product_id identificador del producto que contiene
	 * @apiSuccess {interger} product_values cantidad de productos en el cilindro
	 * @apiSuccess {interger} min_product_values cantidad minima de productos tolerable
	 * @apiSuccess {boolean}  status 1: cilindro activo 0: cilindro inactivo
	 * @apiSuccess {boolean}  alert 1: alertas activadas 0: alertas desactivadas
	 * @apiSuccess {Date}	created_ atfecha de creación
	 * @apiSuccess {Date}	updated_at fecha de ultima modificación
	 * 
	 * 
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
     *	{
     *   "id": 1,
     *   "machine_id": 4,
     *   "product_values": "0",
     *   "product_id": 3,
     *   "min_product_values": 0,
     *   "status": 1,
     *   "alert": 1,
     *   "created_at": "2018-02-16 00:34:38",
     *   "updated_at": "2018-02-16 00:34:38"
     *	}
	 *
	 * 
	 * @apiError machine_id_integer Error en la selección de maquina',
     * @apiError machine_id_required Seleccione una maquina',
	 * @apiError machine_id_exists Ups! alguien debio borrar la maquina, porfavor recargue la página',
	 *
     * @apiError product_values_required El nivel de productos no puede ser nulo',
     * @apiError product_values_integer El nivel de productos debe ser un número',
	 * @apiError product_values_min La cantidad de productos no puede ser negativa',
	 *
     * @apiError min_product_values_integer La cantidad minima de productos debe ser un entero',
     * @apiError min_product_values_required La cantidad minima de productos no puede ser nula',
	 * @apiError min_product_values_min La cantidad minima de productos no puede ser negativa',
	 *
     * @apiError status_boolean Error en el campo Estatus, recargue la página',
	 * @apiError status_required Seleccione un estatus',
	 *
     * @apiError product_id_exists Ups! alguien debio borrar el producto, porfavor recargue la página',
     * @apiError product_id_integer El producto seleccionado no existe, recargue la pagina y pruebe de nuevo',
     * @apiError product_id_required El producto no puede ser nulo',
	 * 
	 *
 * @apiErrorExample Bad-Request:
	 *     HTTP/1.1 400	Bad Request
	 *{
   *  "product_id": 
   *  [
   *    "Ups! alguien debio borrar el producto, porfavor recargue la página"
	 *	]
   *  "status": 
   *  [
	 *    "Seleccione un estatus"
	 *  ]
	 *}
	 */
	public function store()
	{

	}

	/**
	 * @api {put} /api/tank/:id Actualizar
	 * @apiVersion 0.1.0
	 * @apiName PutTank
	 * @apiGroup Tank
	 *
	 * @apiParam {Number} id identificador del cilindro
	 * @apiParam {interger} machine_id identificador de la maquina a la que pertenece
	 * @apiParam {interger} product_id identificador del producto que contiene
	 * @apiParam {interger} product_values cantidad de productos en el cilindro
	 * @apiParam {interger} min_product_values cantidad minima de productos tolerable
	 * @apiParam {boolean}  status 1: cilindro activo 0: cilindro inactivo
	 * @apiParam {boolean}  alert 1: alertas activadas 0: alertas desactivadas
	 * @apiParam {Date}	created_ atfecha de creación
	 * @apiParam {Date}	updated_at fecha de ultima modificación
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
     *	{
     *   "id": 1,
     *   "machine_id": 6,
     *   "product_values": "0",
     *   "product_id": 3,
     *   "min_product_values": 0,
     *   "status": 1,
     *   "alert": 1,
     *   "created_at": "2018-02-16 00:34:38",
     *   "updated_at": "2018-02-16 00:34:38"
     *	}
	 *
	 * @apiError TankNotFound no se encuentra el tanque.
	 * @apiError machine_id_integer Error en la selección de maquina',
     * @apiError machine_id_required Seleccione una maquina',
	 * @apiError machine_id_exists Ups! alguien debio borrar la maquina, porfavor recargue la página',
	 *
     * @apiError product_values_required El nivel de productos no puede ser nulo',
     * @apiError product_values_integer El nivel de productos debe ser un número',
	 * @apiError product_values_min La cantidad de productos no puede ser negativa',
	 *
     * @apiError min_product_values_integer La cantidad minima de productos debe ser un entero',
     * @apiError min_product_values_required La cantidad minima de productos no puede ser nula',
	 * @apiError min_product_values_min La cantidad minima de productos no puede ser negativa',
	 *
     * @apiError status_boolean Error en el campo Estatus, recargue la página',
	 * @apiError status_required Seleccione un estatus',
	 *
     * @apiError product_id_exists Ups! alguien debio borrar el producto, porfavor recargue la página',
     * @apiError product_id_integer El producto seleccionado no existe, recargue la pagina y pruebe de nuevo',
     * @apiError product_id_required El producto no puede ser nulo',
	 * 
	 * @apiErrorExample Error-TankNotFoun:
	 *     HTTP/1.1 404 Not found
	 *{
	 *  "error": "No query results for model [App\\Tank]."
	 *}
	 * 
	 * @apiErrorExample Bad-Request:
	 *     HTTP/1.1 400	Bad Request
	 *{
   *  "product_id": 
   *  [
   *    "Ups! alguien debio borrar el producto, porfavor recargue la página"
	 *	]
   *  "status": 
   *  [
	 *    "Seleccione un estatus"
	 *  ]
	 *}
	 */
	public function update()
	{

	}

	/**
	 * @api {delete} api/tank/:id Eliminar
	 * @apiVersion 0.1.0
	 * @apiName DeleteTank
	 * @apiGroup Tank
	 *
	 * @apiParam {Number} id Identificador unicode de la cilindro
	 *
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "true"
	 *     }
	 *
	 * @apiError TankNotFound The id of the Tank was not found.
	 *
	 * @apiErrorExample Error-TankNotFoun:
	 *     HTTP/1.1 404 Not found
	 *{
	 *  "error": "No query results for model [App\\Tank]."
	 *}
	 */
	public function delete()
	{

	}
}