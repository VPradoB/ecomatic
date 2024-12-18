define({ "api": [
  {
    "type": "delete",
    "url": "/api/company/:id",
    "title": "Eliminar",
    "version": "0.1.0",
    "name": "DeleteCompany",
    "group": "Company",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador unicode de la compañia</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "CompanyNotFound no se encuentra la compañia.",
          "content": "\n    HTTP/1.1 404 CompanyNotFound\n{\n \"error\": \"No query results for model [App\\\\Company].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/company.php",
    "groupTitle": "Company"
  },
  {
    "type": "get",
    "url": "/api/company/:id",
    "title": "Mostrar",
    "version": "0.1.0",
    "name": "GetCompany",
    "group": "Company",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "direction",
            "description": "<p>dirección de compañia</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "phone_number",
            "description": "<p>número telefonico</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{     \n \"id\": 2,\n \"name\": \"foo2\",\n \"direction\": \"bar2\",\n \"phone_number\": \"(0800) 123-4567\",\n \"created_at\": \"2018-02-16 15:11:28\",\n \"updated_at\": \"2018-02-16 15:11:28\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "CompanyNotFound",
            "description": "<p>The id of the Company was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-CompanyNotFound:",
          "content": "    HTTP/1.1 404 CompanyNotFound\n{\n \"error\": \"No query results for model [App\\\\Company].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/company.php",
    "groupTitle": "Company"
  },
  {
    "type": "get",
    "url": "/api/company",
    "title": "Listar",
    "version": "0.1.0",
    "name": "IndexCompany",
    "group": "Company",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "direction",
            "description": "<p>dirección de compañia</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "phone_number",
            "description": "<p>número telefonico</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n[\n {\n   \"id\": 1,\n   \"name\": \"Google\",\n   \"direction\": \"Sillicon Valley\",\n   \"phone_number\": \"(0500) 005-0055\",\n   \"created_at\": \"2018-02-15 15:11:28\",\n   \"updated_at\": \"2018-02-15 15:11:28\"\n },\n {     \n   \"id\": 2,\n   \"name\": \"foo2\",\n   \"direction\": \"bar2\",\n   \"phone_number\": \"(0800) 123-4567\",\n   \"created_at\": \"2018-02-16 15:11:28\",\n   \"updated_at\": \"2018-02-16 15:11:28\"\n }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "classes/company.php",
    "groupTitle": "Company"
  },
  {
    "type": "post",
    "url": "/api/company",
    "title": "Crear",
    "version": "0.1.0",
    "name": "PostCompany",
    "group": "Company",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "direction",
            "description": "<p>dirección de compañia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone_number",
            "description": "<p>número telefonico</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "direction",
            "description": "<p>dirección de compañia</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "phone_number",
            "description": "<p>número telefonico</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n \"id\": 1,\n \"name\": \"Google\",\n \"direction\": \"Sillicon Valley\",\n \"phone_number\": \"(0500) 005-0055\",\n \"created_at\": \"2018-02-15 15:11:28\",\n \"updated_at\": \"2018-02-15 15:11:28\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>El nombre de la compañia debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_max",
            "description": "<p>El nombre de la compañia ha excedido el tamaño maximo (100 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_required",
            "description": "<p>Se requiere un nombre para la compañia</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "direction_string",
            "description": "<p>La direción de la compañia debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "direction_max",
            "description": "<p>La dirección de la compañia ha excedido el tamaño maximo (100 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "direction_required",
            "description": "<p>Se requiere una dirección para la compañia</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "phone_number_string",
            "description": "<p>El número de teléfono de la compañia debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "phone_number_max",
            "description": "<p>El número de teléfono de la compañia ha excedido el tamaño maximo (100 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "phone_number_required",
            "description": "<p>El número de teléfono de la compañia</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad-Request:",
          "content": "    HTTP/1.1 400\tBad Request\n{\n \"name\": \n [\n   \"Se requiere un nombre para la compañia\"\n ],\n \"direction\": \n [\n   \"Se requiere una dirección para la compañia\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/company.php",
    "groupTitle": "Company"
  },
  {
    "type": "put",
    "url": "/api/company/:id",
    "title": "Actualizar",
    "version": "0.1.0",
    "name": "PutCompany",
    "group": "Company",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador de la compañia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "direction",
            "description": "<p>dirección de compañia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone_number",
            "description": "<p>número telefonico</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\tHTTP/1.1 200 OK\n{\n \"id\": 1,\n \"name\": \"Google\",\n \"direction\": \"Sillicon Valley\",\n \"phone_number\": \"(0500) 005-0055\",\n \"created_at\": \"2018-02-15 15:11:28\",\n \"updated_at\": \"2018-02-15 15:11:28\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "id_NotFound",
            "description": "<p>no se ha encontrado la compañia 404</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>El nombre de la compañia debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_max",
            "description": "<p>El nombre de la compañia ha excedido el tamaño maximo (100 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "direction_string",
            "description": "<p>La direción de la compañia debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "direction_max",
            "description": "<p>La dirección de la compañia ha excedido el tamaño maximo (100 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "phone_number_string",
            "description": "<p>El número de teléfono de la compañia debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "phone_number_max",
            "description": "<p>El número de teléfono de la compañia ha excedido el tamaño maximo (100 caracteres)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-CompanyNotFound:",
          "content": "    HTTP/1.1 404 CompanyNotFound\n{\n \"error\": \"No query results for model [App\\\\Company].\"\n}",
          "type": "json"
        },
        {
          "title": "Error-BadRequest:",
          "content": "    HTTP/1.1 400 Bad Request\n{\n \"name\": \n [\n   \"Se el nombre de la compañia no es un texto\"\n ],\n \"direction\": \n [\n   \"La dirección de la compañia ha excedido el tamaño maximo (100 caracteres)\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/company.php",
    "groupTitle": "Company"
  },
  {
    "type": "delete",
    "url": "/api/configuration/:id",
    "title": "Eliminar",
    "version": "0.1.0",
    "name": "DeleteConfiguration",
    "group": "Configuration",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador unico de de la configuración</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ConfigurationNotFound",
            "description": "<p>no se encuentra la maquina error 404.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ConfigurationNotFound:",
          "content": "HTTP/1.1 404\n{\n    \"error\": \"No query results for model [App\\\\Configuration].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/configuration.php",
    "groupTitle": "Configuration"
  },
  {
    "type": "get",
    "url": "/api/configurationy/:id",
    "title": "Mostrar",
    "version": "0.1.0",
    "name": "GetConfiguration",
    "group": "Configuration",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "value",
            "description": "<p>valor de la configuración</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripción</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificacións</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n \"id\": 1,\n \"name\": \"frecuencia de alerta\",\n \"value\": \"120\",\n \"description\": \"cantidad de tiempo entre reporte de maquinas\"\n \"created_at\": \"2018-02-15 15:11:28\",\n \"updated_at\": \"2018-02-15 15:11:28\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ConfigurationNotFound",
            "description": "<p>The id of the Configuration was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-ConfigurationNotFound:",
          "content": "    HTTP/1.1 404 ConfigurationNotFound\n{\n   \"error\": \"No query results for model [App\\\\Configuration].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/configuration.php",
    "groupTitle": "Configuration"
  },
  {
    "type": "get",
    "url": "/api/configuration",
    "title": "Listar",
    "version": "0.1.0",
    "name": "IndexConfiguration",
    "group": "Configuration",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "value",
            "description": "<p>valor de la configuración</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripción</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n[\n {\n   \"id\": 1,\n   \"name\": \"frecuencia de alerta\",\n   \"value\": \"120\",\n   \"description\": \"cantidad de tiempo entre reporte de maquinas\"\n   \"created_at\": \"2018-02-15 15:11:28\",\n   \"updated_at\": \"2018-02-15 15:11:28\",\n},\n{     \n   \"id\": 2,\n   \"name\": \"foo\",\n   \"value\": \"2\",\n   \"description\": \"some description\"\n   \"created_at\": \"2018-02-16 15:11:28\",\n   \"updated_at\": \"2018-02-16 15:11:28\",\n }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "classes/configuration.php",
    "groupTitle": "Configuration"
  },
  {
    "type": "post",
    "url": "/api/configuration",
    "title": "Crear",
    "version": "0.1.0",
    "name": "PostConfiguration",
    "group": "Configuration",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "value",
            "description": "<p>valor de la configuración</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripción</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "value",
            "description": "<p>valor de la configuración</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripción</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n \"id\": 1,\n \"name\": \"frecuencia de alerta\",\n \"value\": \"120\",\n \"description\": \"cantidad de tiempo entre reporte de maquinas\",\n \"created_at\": \"2018-02-15 15:11:28\",\n \"updated_at\": \"2018-02-15 15:11:28\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code_unique",
            "description": "<p>El codigo de la configuración debe ser unico</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code_required",
            "description": "<p>Se requiere un codigo</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code_max",
            "description": "<p>El codigo excede debe ser de 5 caracteres o menos</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "value_integer",
            "description": "<p>El valor debe ser entero</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "value_required",
            "description": "<p>Se requiere un valor</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "description_string",
            "description": "<p>La descripción excede tamaño maximo (240 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "description_required",
            "description": "<p>Se requiere una descripción</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad-Request:",
          "content": "    HTTP/1.1 400\tBadRequest\n{\n \"code\": \n [\n   \"El codigo excede debe ser de 5 caracteres o menos\"\n ],\n \"value\": \n [\n   \"Se requiere un valor\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/configuration.php",
    "groupTitle": "Configuration"
  },
  {
    "type": "put",
    "url": "/api/configuration/:id",
    "title": "Actualizar",
    "version": "0.1.0",
    "name": "PutConfiguration",
    "group": "Configuration",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador de la cofiguracion</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "value",
            "description": "<p>valor de la configuración</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripción de la configuración</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n\t\"id\": :id,\n\t\"name\": \"frecuencia de alerta\",\n\t\"value\": \"120\",\n\t\"description\": \"cantidad de tiempo entre reporte de maquinas\",\n\t\"created_at\": \"2018-02-15 15:11:28\",\n\t\"updated_at\": \"2018-02-15 15:11:28\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "id_NotFound",
            "description": "<p>error 404 configurationNotFound</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code_unique",
            "description": "<p>El codigo de la configuración debe ser unico</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code_max",
            "description": "<p>El codigo excede debe ser de 5 caracteres o menos</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "value_integer",
            "description": "<p>El valor debe ser entero</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "description_string",
            "description": "<p>La descripción excede tamaño maximo (240 caracteres)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-ConfigurationNotFound:",
          "content": "    HTTP/1.1 404 Bad Response\n{\n \"error\": \"No query results for model [App\\\\Configuration].\"\n}",
          "type": "json"
        },
        {
          "title": "Error-BadRequest:",
          "content": "    HTTP/1.1 400 Bad Request\n{\n \"code\": \n [\n   \"El codigo excede debe ser de 5 caracteres o menos\"\n ],\n \"value\": \n [\n   \"El valor debe ser entero\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/configuration.php",
    "groupTitle": "Configuration"
  },
  {
    "type": "delete",
    "url": "/api/machine/:id",
    "title": "Eliminar",
    "version": "0.1.0",
    "name": "DeleteMachine",
    "group": "Machine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador unicode de la maquina</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "MachineNotFound",
            "description": "<p>no se encuentra la maquina</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ErrorResponse:",
          "content": " HTTP/1.1 404 MachineNotFound\n{\n \"error\": \"No query results for model [App\\\\Machine].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/machine.php",
    "groupTitle": "Machine"
  },
  {
    "type": "get",
    "url": "/api/machine/:id",
    "title": "Mostrar",
    "version": "0.1.0",
    "name": "GetMachine",
    "group": "Machine",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "mac",
            "description": "<p>codigo alternativo</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "ubication",
            "description": "<p>ubicacion actual</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "deleted_at",
            "description": "<p>fecha de eliminación en caso de borrado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{     \n  \t\"id\": 2,\n  \t\"mac\": \"#002\",\n  \t\"name\": \"foo2\",\n  \t\"ubication\": \"bar2\",\n  \t\"created_at\": \"2018-02-16 15:11:28\",\n  \t\"updated_at\": \"2018-02-16 15:11:28\",\n  \t\"deleted_at\": \"2018-02-17 15:11:28\"\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "MachineNotFound",
            "description": "<p>The id of the User was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ErrorResponse:",
          "content": " HTTP/1.1 404 MachineNotFound\n{\n \"error\": \"No query results for model [App\\\\Machine].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/machine.php",
    "groupTitle": "Machine"
  },
  {
    "type": "get",
    "url": "/api/machine",
    "title": "Listar",
    "version": "0.1.0",
    "name": "IndexMachine",
    "group": "Machine",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "mac",
            "description": "<p>codigo alternativo</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "ubication",
            "description": "<p>ubicacion actual</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "fecha",
            "description": "<p>de eliminación en caso de borrado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n[\n\t{\n  \t\"id\": 1,\n  \t\"mac\": \"#001\",\n  \t\"name\": \"foo\",\n  \t\"ubication\": \"bar\",\n  \t\"created_at\": \"2018-02-15 15:11:28\",\n  \t\"updated_at\": \"2018-02-15 15:11:28\",\n  \t\"deleted_at\": null\n\t},\n\t{     \n  \t\"id\": 2,\n  \t\"mac\": \"#002\",\n  \t\"name\": \"foo2\",\n  \t\"ubication\": \"bar2\",\n  \t\"created_at\": \"2018-02-16 15:11:28\",\n  \t\"updated_at\": \"2018-02-16 15:11:28\",\n  \t\"deleted_at\": \"2018-02-17 15:11:28\"\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "classes/machine.php",
    "groupTitle": "Machine"
  },
  {
    "type": "post",
    "url": "/api/machine",
    "title": "Crear",
    "version": "0.1.0",
    "name": "PostMachine",
    "group": "Machine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "mac",
            "description": "<p>codigo alternativo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ubication",
            "description": "<p>ubicacion actual</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "mac",
            "description": "<p>codigo alternativo</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "ubication",
            "description": "<p>ubicacion actual</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "deleted_at",
            "description": "<p>fecha de eliminación en caso de borrado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{     \n  \t\"id\": 2,\n  \t\"mac\": \"#002\",\n  \t\"name\": \"foo2\",\n  \t\"ubication\": \"bar2\",\n  \t\"created_at\": \"2018-02-16 15:11:28\",\n  \t\"updated_at\": \"2018-02-16 15:11:28\",\n  \t\"deleted_at\": \"2018-02-17 15:11:28\"\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "mac_required",
            "description": "<p>MAC requerido</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "mac_string",
            "description": "<p>MAC no es un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "mac_max",
            "description": "<p>MAC excedio el tamaño maximo (254 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_required",
            "description": "<p>nombre requerido</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>nombre no es un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_max",
            "description": "<p>nombre excedio el tamaño maximo (254 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ubication_required",
            "description": "<p>ubiacion requerida</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ubication_string",
            "description": "<p>ubicacion no es un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ubiation_max",
            "description": "<p>ubicación excedio el tamaño maximo (254 caracteres)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "BadRequest:",
          "content": "    HTTP/1.1 400\tBad Request\n{\n \"mac\": \n [\n   \"MAC duplicado\"\n ]\n \"name\": \n [\n \"nombre requerido\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/machine.php",
    "groupTitle": "Machine"
  },
  {
    "type": "put",
    "url": "/api/machine/:id",
    "title": "Actualizar",
    "version": "0.1.0",
    "name": "PutMachine",
    "group": "Machine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador de la maquina</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "mac",
            "description": "<p>codigo alternativo a modificar</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre a modificar</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ubication",
            "description": "<p>ubicacion actual a modificar</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{     \n  \t\"id\": :id,\n  \t\"mac\": \"#006\",\n  \t\"name\": \"foo2\",\n  \t\"ubication\": \"bar2\",\n  \t\"created_at\": \"2018-02-16 15:11:28\",\n  \t\"updated_at\": \"2018-02-16 15:11:28\",\n  \t\"deleted_at\": \"2018-02-17 15:11:28\"\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "MachineNotFound",
            "description": "<p>el id de la maquina no existe</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "mac_unique",
            "description": "<p>MAC duplicado</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "mac_string",
            "description": "<p>MAC no es un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "mac_max",
            "description": "<p>MAC excedio el tamaño maximo (254 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>nombre no es un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_max",
            "description": "<p>nombre excedio el tamaño maximo (254 caracteres)</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ubication_string",
            "description": "<p>ubicacion no es un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ubiation_max",
            "description": "<p>ubicación excedio el tamaño maximo (254 caracteres)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ErrorResponse:",
          "content": " HTTP/1.1 404 MachineNotFound\n{\n \"error\": \"No query results for model [App\\\\Machine].\"\n}",
          "type": "json"
        },
        {
          "title": "Error-BaD-Request:",
          "content": "    HTTP/1.1 400 Bad Request\n{\n\t\"mac\": [\n  \t\"MAC duplicado \"\n\t]\n\t\"name: [\n\t\t\"nombre excedio el tamaño maximo(254 caracteres)\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/machine.php",
    "groupTitle": "Machine"
  },
  {
    "type": "get",
    "url": "/api/machine/:id/tanks",
    "title": "Listar cilindros",
    "version": "0.1.0",
    "name": "getTanks",
    "group": "Machine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador unicode de la maquina</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n[\n   {\n\t    \"id\": 1,\n\t    \"machine_id\": 4,\n\t    \"product_values\": \"0\",\n\t    \"product_id\": 3,\n\t    \"min_product_values\": 0,\n\t    \"status\": 1,\n\t    \"alert\": 1,\n\t    \"created_at\": \"2018-02-16 00:34:38\",\n\t    \"updated_at\": \"2018-02-16 00:34:38\",\n   \t\"deleted_at\": null\n\t},\n\t{\n\t    \"id\": 2,\n\t    \"machine_id\": 4,\n\t    \"product_values\": \"0\",\n\t    \"product_id\": 3,\n\t    \"min_product_values\": 0,\n\t    \"status\": 1,\n\t    \"alert\": 1,\n\t    \"created_at\": \"2018-02-16 00:34:43\",\n\t    \"updated_at\": \"2018-02-16 00:34:43\",\n\t    \"deleted_at\": null\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "MachineNotFound",
            "description": "<p>The id of the User was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ErrorResponse:",
          "content": " HTTP/1.1 404 MachineNotFound\n{\n \"error\": \"No query results for model [App\\\\Machine].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/machine.php",
    "groupTitle": "Machine"
  },
  {
    "type": "delete",
    "url": "/api/product/:id",
    "title": "Eliminar",
    "version": "0.1.0",
    "name": "DeleteProduct",
    "group": "Product",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador unicode del producto</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ProductNotFound",
            "description": "<p>no se encuentra el producto.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ProductNotFound:",
          "content": "    HTTP/1.1 404 Bad Response\n{\n\t\"error\": \"No query results for model [App\\\\Product].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/product.php",
    "groupTitle": "Product"
  },
  {
    "type": "get",
    "url": "/api/product/:id",
    "title": "Mostrar",
    "version": "0.1.0",
    "name": "GetProduct",
    "group": "Product",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "price",
            "description": "<p>precio</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "deleted_at",
            "description": "<p>fecha de eliminación en caso de borrado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{\n\t    \"id\": 4,\n\t    \"name\": \"Non qui.\",\n\t    \"price\": 5880,\n\t    \"created_at\": \"2018-02-15 22:49:36\",\n\t    \"updated_at\": \"2018-02-15 22:49:36\",\n\t    \"deleted_at\": null\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ProductNotFound",
            "description": "<p>no se pudo encontrar el producto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ProductNotFound:",
          "content": "    HTTP/1.1 404 Bad Response\n{\n\t\"error\": \"No query results for model [App\\\\Product].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/product.php",
    "groupTitle": "Product"
  },
  {
    "type": "get",
    "url": "/api/product",
    "title": "Listar",
    "version": "0.1.0",
    "name": "IndexProduct",
    "group": "Product",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "price",
            "description": "<p>precio</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "fecha",
            "description": "<p>de eliminación en caso de borrado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n[\n\t{\n\t    \"id\": 3,\n\t    \"name\": \"Principal\",\n\t   \"price\": 50000,\n\t    \"created_at\": \"2018-02-15 13:56:10\",\n\t    \"updated_at\": \"2018-02-15 13:56:10\",\n\t    \"deleted_at\": null\n\t},\n\t{\n\t    \"id\": 4,\n\t    \"name\": \"Non qui.\",\n\t    \"price\": 5880,\n\t    \"created_at\": \"2018-02-15 22:49:36\",\n\t    \"updated_at\": \"2018-02-15 22:49:36\",\n\t    \"deleted_at\": null\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "classes/product.php",
    "groupTitle": "Product"
  },
  {
    "type": "post",
    "url": "/api/product",
    "title": "Crear",
    "version": "0.1.0",
    "name": "PostProduct",
    "group": "Product",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre a modificar</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "precio",
            "description": "<p>del producto</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{\n\t    \"id\": 4,\n\t    \"name\": \"Non qui.\",\n\t    \"price\": 5880,\n\t    \"created_at\": \"2018-02-15 22:49:36\",\n\t    \"updated_at\": \"2018-02-15 22:49:36\",\n\t    \"deleted_at\": null\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ProductNotFound",
            "description": "<p>el id del producto no existe.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_required",
            "description": "<p>El nombre de producto es necesario</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>El nombre debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_max",
            "description": "<p>Nombre debe tener maximo 100 caracteres</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "price_required",
            "description": "<p>Se necesita un precio para el producto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "price_min",
            "description": "<p>El precio no puede ser negativo</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "price_integer",
            "description": "<p>'El precio debe ser un número entero</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ProductNotFound:",
          "content": "    HTTP/1.1 404 Bad Response\n{\n\t\"error\": \"No query results for model [App\\\\Product].\"\n}",
          "type": "json"
        },
        {
          "title": "Error-BadRequest:",
          "content": "    HTTP/1.1 400 Bad Request\n{\n\t\"price\": \n\t[\n\t\t\"el precio debe ser un número entero\"\n\t]\n\t\"name\": \n\t[\n\t\t\"nombre excedio el tamaño maximo(254 caracteres)\"\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/product.php",
    "groupTitle": "Product"
  },
  {
    "type": "put",
    "url": "/api/machine/:id",
    "title": "Actualizar",
    "version": "0.1.0",
    "name": "PutProduct",
    "group": "Product",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre a modificar</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "precio",
            "description": "<p>del producto</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{\n\t    \"id\": 4,\n\t    \"name\": \"Non qui.\",\n\t    \"price\": 5880,\n\t    \"created_at\": \"2018-02-15 22:49:36\",\n\t    \"updated_at\": \"2018-02-15 22:49:36\",\n\t    \"deleted_at\": null\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ProductNotFound",
            "description": "<p>el id del producto no existe, error 500.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_required",
            "description": "<p>El nombre de producto es necesario</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>El nombre debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_max",
            "description": "<p>Nombre debe tener maximo 100 caracteres</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "price_required",
            "description": "<p>Se necesita un precio para el producto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "price_min",
            "description": "<p>El precio no puede ser negativo</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "price_integer",
            "description": "<p>'El precio debe ser un número entero</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "ProductNotFound:",
          "content": "    HTTP/1.1 404 Bad Response\n{\n\t\"error\": \"No query results for model [App\\\\Product].\"\n}",
          "type": "json"
        },
        {
          "title": "Error-BadRequest:",
          "content": "    HTTP/1.1 400 Bad Request\n{\n\t\"price\": \n\t[\n\t\t\"el precio debe ser un número entero\"\n\t]\n\t\"name\": \n\t[\n\t\t\"nombre excedio el tamaño maximo(254 caracteres)\"\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/product.php",
    "groupTitle": "Product"
  },
  {
    "type": "delete",
    "url": "/api/publicity/:id",
    "title": "Eliminar",
    "version": "0.1.0",
    "name": "DeletePublicity",
    "group": "Publicity",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador unico de de la publicidad</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "PublicityNotFound no se encuentra la publicidad.",
          "content": "\n    HTTP/1.1 404 PublicidadNotFound\n{\n \"error\": \"No query results for model [App\\\\Publicity].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/publicity.php",
    "groupTitle": "Publicity"
  },
  {
    "type": "get",
    "url": "/api/publicity/:id",
    "title": "Mostrar",
    "version": "0.1.0",
    "name": "GetPublicty",
    "group": "Publicity",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripcion de la publicidad</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "company_id",
            "description": "<p>identificador de la compañia que hizo la publicidad</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "logo",
            "description": "<p>nombre de logo en /storage/img</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "vid",
            "description": "<p>nombre de video en /storage/img</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"id\": 1,\n       \"name\": \"Principal\",\n       \"description\": \"not defined\",\n       \"company_id\": 1,\n       \"vid\": \"sample video.mp4\",\n       \"logo\": \"sample image.jpg\",\n       \"created_at\": \"2018-02-17 10:24:45\",\n       \"updated_at\": \"2018-02-17 10:24:45\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "PublicityNotFound",
            "description": "<p>The id of the Publicty was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-PublicityNotFound:",
          "content": "    HTTP/1.1 404 PublicityNotFound\n{\n \"error\": \"No query results for model [App\\\\Publicity].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/publicity.php",
    "groupTitle": "Publicity"
  },
  {
    "type": "get",
    "url": "/api/publicity",
    "title": "Listar",
    "version": "0.1.0",
    "name": "IndexPublicity",
    "group": "Publicity",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripcion de la publicidad</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "company_id",
            "description": "<p>identificador de la compañia que hizo la publicidad</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "logo",
            "description": "<p>nombre de logo en storage/img</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "vid",
            "description": "<p>nombre de video en storage/img</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n[\n    {\n        \"id\": 1,\n        \"name\": \"Principal\",\n        \"description\": \"not defined\",\n        \"company_id\": 1,\n        \"vid\": \"sample video.mp4\",\n        \"logo\": \"sample image.jpg\",\n        \"created_at\": \"2018-02-17 10:24:45\",\n        \"updated_at\": \"2018-02-17 10:24:45\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "classes/publicity.php",
    "groupTitle": "Publicity"
  },
  {
    "type": "post",
    "url": "/api/publicity",
    "title": "Crear",
    "version": "0.1.0",
    "name": "PostPublicity",
    "group": "Publicity",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripcion de la publicidad</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "company_id",
            "description": "<p>identificador de la compañia que hizo la publicidad</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "logo",
            "description": "<p>nombre de logo en /storage/img</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "vid",
            "description": "<p>nombre de video en /storage/img</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripcion de la publicidad</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "company_id",
            "description": "<p>identificador de la compañia que hizo la publicidad</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "logo",
            "description": "<p>nombre de logo en /storage/img</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "vid",
            "description": "<p>nombre de video en /storage/img</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": "<p>fecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n   {\n       \"id\": 1,\n       \"name\": \"Principal\",\n       \"description\": \"not defined\",\n       \"company_id\": 1,\n       \"vid\": \"sample video.mp4\",\n       \"logo\": \"sample image.jpg\",\n       \"created_at\": \"2018-02-17 10:24:45\",\n       \"updated_at\": \"2018-02-17 10:24:45\"\n   }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "description_string",
            "description": "<p>La descripción debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "description_required",
            "description": "<p>La descripción es requerida</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>el nombre debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_required",
            "description": "<p>El nombre se requiere</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "company_id_integer",
            "description": "<p>Esa compañia no existe, recargue la página</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "company_id_required",
            "description": "<p>Se requiere una compañia</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "logo_file",
            "description": "<p>El logo debe ser una imagen</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "logo_required",
            "description": "<p>El logo es necesario</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "logo_image",
            "description": "<p>El logo debe ser una imagen</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_file",
            "description": "<p>El video debe ser de tipo mp4, ogg o webm</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_mimes",
            "description": "<p>El video debe ser de tipo mp4, ogg o webm</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_required",
            "description": "<p>El video es necesario</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_duplicated",
            "description": "<p>nombre de video existente</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad-Request:",
          "content": "    HTTP/1.1 400\tBad Request\n{\n \"name\": \n [\n   \"El nombre se requiere\"\n ],\n \"vid\": \n [\n   \"El video es necesario\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/publicity.php",
    "groupTitle": "Publicity"
  },
  {
    "type": "put",
    "url": "/api/publicity/:id",
    "title": "Actualizar",
    "version": "0.1.0",
    "name": "PutPublicity",
    "group": "Publicity",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": ":id",
            "description": "<p>identificador</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>nombre</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>descripcion de la publicidad</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "company_id",
            "description": "<p>identificador de la compañia que hizo la publicidad</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "logo",
            "description": "<p>nombre de logo para guardar en /storage/img</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "vid",
            "description": "<p>nombre de video para guardar en /storage/img</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\tHTTP/1.1 200 OK\n    {\n        \"id\": 1,\n        \"name\": \"Principal\",\n        \"description\": \"not defined\",\n        \"company_id\": 1,\n        \"vid\": \"sample video.mp4\",\n        \"logo\": \"sample image.jpg\",\n        \"created_at\": \"2018-02-17 10:24:45\",\n        \"updated_at\": \"2018-02-17 10:24:45\"\n    }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "description_string",
            "description": "<p>La descripción debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "description_required",
            "description": "<p>La descripción es requerida</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_string",
            "description": "<p>el nombre debe ser un texto</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "name_required",
            "description": "<p>El nombre se requiere</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "company_id_integer",
            "description": "<p>Esa compañia no existe, recargue la página</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "company_id_required",
            "description": "<p>Se requiere una compañia</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "logo_file",
            "description": "<p>El logo debe ser una imagen</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "logo_required",
            "description": "<p>El logo es necesario</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "logo_image",
            "description": "<p>El logo debe ser una imagen</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_file",
            "description": "<p>El video debe ser de tipo mp4, ogg o webm</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_mimes",
            "description": "<p>El video debe ser de tipo mp4, ogg o webm</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_required",
            "description": "<p>El video es necesario</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "vid_duplicated",
            "description": "<p>nombre de video existente</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-PublicityNotFound:",
          "content": "    HTTP/1.1 404 PublicityNotFound\n{\n \"error\": \"No query results for model [App\\\\Publicity].\"\n}",
          "type": "json"
        },
        {
          "title": "Error-BadRequest:",
          "content": "    HTTP/1.1 400 Bad Request\n{\n \"name\": \n [\n   \"El nombre se requiere\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/publicity.php",
    "groupTitle": "Publicity"
  },
  {
    "type": "delete",
    "url": "api/tank/:id",
    "title": "Eliminar",
    "version": "0.1.0",
    "name": "DeleteTank",
    "group": "Tank",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador unicode de la cilindro</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"true\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "TankNotFound",
            "description": "<p>The id of the Tank was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-TankNotFoun:",
          "content": "    HTTP/1.1 404 Not found\n{\n \"error\": \"No query results for model [App\\\\Tank].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/tank.php",
    "groupTitle": "Tank"
  },
  {
    "type": "get",
    "url": "api/tank/:id",
    "title": "Mostrar",
    "version": "0.1.0",
    "name": "GetTank",
    "group": "Tank",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador del cilindro</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "machine_id",
            "description": "<p>identificador de la maquina a la que pertenece</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "product_id",
            "description": "<p>identificador del producto que contiene</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "product_values",
            "description": "<p>cantidad de productos en el cilindro</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "min_product_values",
            "description": "<p>cantidad minima de productos tolerable</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "status",
            "description": "<p>1: cilindro activo 0: cilindro inactivo</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "alert",
            "description": "<p>1: alertas activadas 0: alertas desactivadas</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_",
            "description": "<p>atfecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{\n  \"id\": 1,\n  \"machine_id\": 4,\n  \"product_values\": \"0\",\n  \"product_id\": 3,\n  \"min_product_values\": 0,\n  \"status\": 1,\n  \"alert\": 1,\n  \"created_at\": \"2018-02-16 00:34:38\",\n  \"updated_at\": \"2018-02-16 00:34:38\"\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "TankNotFound",
            "description": "<p>The id of the User was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-TankNotFoun:",
          "content": "    HTTP/1.1 404 Not found\n{\n \"error\": \"No query results for model [App\\\\Tank].\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/tank.php",
    "groupTitle": "Tank"
  },
  {
    "type": "get",
    "url": "/api/Tank",
    "title": "Listar",
    "version": "0.1.0",
    "name": "IndexTank",
    "group": "Tank",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador del cilindro</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "machine_id",
            "description": "<p>identificador de la maquina a la que pertenece</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "product_id",
            "description": "<p>identificador del producto que contiene</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "product_values",
            "description": "<p>cantidad de productos en el cilindro</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "min_product_values",
            "description": "<p>cantidad minima de productos tolerable</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "status",
            "description": "<p>1: cilindro activo 0: cilindro inactivo</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "alert",
            "description": "<p>1: alertas activadas 0: alertas desactivadas</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_",
            "description": "<p>atfecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n[\n\t{\n  \"id\": 1,\n  \"machine_id\": 4,\n  \"product_values\": \"0\",\n  \"product_id\": 3,\n  \"min_product_values\": 0,\n  \"status\": 1,\n  \"alert\": 1,\n  \"created_at\": \"2018-02-16 00:34:38\",\n  \"updated_at\": \"2018-02-16 00:34:38\"\n\t},\n\t{\n  \"id\": 2,\n  \"machine_id\": 4,\n  \"product_values\": \"0\",\n  \"product_id\": 3,\n  \"min_product_values\": 0,\n  \"status\": 1,\n  \"alert\": 1,\n  \"created_at\": \"2018-02-16 00:34:43\",\n  \"updated_at\": \"2018-02-16 00:34:43\"\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "classes/tank.php",
    "groupTitle": "Tank"
  },
  {
    "type": "post",
    "url": "/api/tank",
    "title": "Crear",
    "version": "0.1.0",
    "name": "PostTank",
    "group": "Tank",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "machine_id",
            "description": "<p>identificador de la maquina a la que pertenece</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "product_id",
            "description": "<p>identificador del producto que contiene</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "product_values",
            "description": "<p>cantidad de productos en el cilindro</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "min_product_values",
            "description": "<p>cantidad minima de productos tolerable</p>"
          },
          {
            "group": "Parameter",
            "type": "boolean",
            "optional": false,
            "field": "status",
            "description": "<p>1: cilindro activo 0: cilindro inactivo</p>"
          },
          {
            "group": "Parameter",
            "type": "boolean",
            "optional": false,
            "field": "alert",
            "description": "<p>1: alertas activadas 0: alertas desactivadas</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": false,
            "field": "created_",
            "description": "<p>atfecha de creación</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador del cilindro</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "machine_id",
            "description": "<p>identificador de la maquina a la que pertenece</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "product_id",
            "description": "<p>identificador del producto que contiene</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "product_values",
            "description": "<p>cantidad de productos en el cilindro</p>"
          },
          {
            "group": "Success 200",
            "type": "interger",
            "optional": false,
            "field": "min_product_values",
            "description": "<p>cantidad minima de productos tolerable</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "status",
            "description": "<p>1: cilindro activo 0: cilindro inactivo</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "alert",
            "description": "<p>1: alertas activadas 0: alertas desactivadas</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_",
            "description": "<p>atfecha de creación</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{\n  \"id\": 1,\n  \"machine_id\": 4,\n  \"product_values\": \"0\",\n  \"product_id\": 3,\n  \"min_product_values\": 0,\n  \"status\": 1,\n  \"alert\": 1,\n  \"created_at\": \"2018-02-16 00:34:38\",\n  \"updated_at\": \"2018-02-16 00:34:38\"\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "machine_id_integer",
            "description": "<p>Error en la selección de maquina',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "machine_id_required",
            "description": "<p>Seleccione una maquina',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "machine_id_exists",
            "description": "<p>Ups! alguien debio borrar la maquina, porfavor recargue la página',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_values_required",
            "description": "<p>El nivel de productos no puede ser nulo',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_values_integer",
            "description": "<p>El nivel de productos debe ser un número',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_values_min",
            "description": "<p>La cantidad de productos no puede ser negativa',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "min_product_values_integer",
            "description": "<p>La cantidad minima de productos debe ser un entero',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "min_product_values_required",
            "description": "<p>La cantidad minima de productos no puede ser nula',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "min_product_values_min",
            "description": "<p>La cantidad minima de productos no puede ser negativa',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status_boolean",
            "description": "<p>Error en el campo Estatus, recargue la página',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status_required",
            "description": "<p>Seleccione un estatus',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_id_exists",
            "description": "<p>Ups! alguien debio borrar el producto, porfavor recargue la página',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_id_integer",
            "description": "<p>El producto seleccionado no existe, recargue la pagina y pruebe de nuevo',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_id_required",
            "description": "<p>El producto no puede ser nulo',</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad-Request:",
          "content": "    HTTP/1.1 400\tBad Request\n{\n \"product_id\": \n [\n   \"Ups! alguien debio borrar el producto, porfavor recargue la página\"\n\t]\n \"status\": \n [\n   \"Seleccione un estatus\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/tank.php",
    "groupTitle": "Tank"
  },
  {
    "type": "put",
    "url": "/api/tank/:id",
    "title": "Actualizar",
    "version": "0.1.0",
    "name": "PutTank",
    "group": "Tank",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identificador del cilindro</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "machine_id",
            "description": "<p>identificador de la maquina a la que pertenece</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "product_id",
            "description": "<p>identificador del producto que contiene</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "product_values",
            "description": "<p>cantidad de productos en el cilindro</p>"
          },
          {
            "group": "Parameter",
            "type": "interger",
            "optional": false,
            "field": "min_product_values",
            "description": "<p>cantidad minima de productos tolerable</p>"
          },
          {
            "group": "Parameter",
            "type": "boolean",
            "optional": false,
            "field": "status",
            "description": "<p>1: cilindro activo 0: cilindro inactivo</p>"
          },
          {
            "group": "Parameter",
            "type": "boolean",
            "optional": false,
            "field": "alert",
            "description": "<p>1: alertas activadas 0: alertas desactivadas</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": false,
            "field": "created_",
            "description": "<p>atfecha de creación</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": "<p>fecha de ultima modificación</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n\t{\n  \"id\": 1,\n  \"machine_id\": 6,\n  \"product_values\": \"0\",\n  \"product_id\": 3,\n  \"min_product_values\": 0,\n  \"status\": 1,\n  \"alert\": 1,\n  \"created_at\": \"2018-02-16 00:34:38\",\n  \"updated_at\": \"2018-02-16 00:34:38\"\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "TankNotFound",
            "description": "<p>no se encuentra el tanque.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "machine_id_integer",
            "description": "<p>Error en la selección de maquina',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "machine_id_required",
            "description": "<p>Seleccione una maquina',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "machine_id_exists",
            "description": "<p>Ups! alguien debio borrar la maquina, porfavor recargue la página',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_values_required",
            "description": "<p>El nivel de productos no puede ser nulo',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_values_integer",
            "description": "<p>El nivel de productos debe ser un número',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_values_min",
            "description": "<p>La cantidad de productos no puede ser negativa',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "min_product_values_integer",
            "description": "<p>La cantidad minima de productos debe ser un entero',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "min_product_values_required",
            "description": "<p>La cantidad minima de productos no puede ser nula',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "min_product_values_min",
            "description": "<p>La cantidad minima de productos no puede ser negativa',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status_boolean",
            "description": "<p>Error en el campo Estatus, recargue la página',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status_required",
            "description": "<p>Seleccione un estatus',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_id_exists",
            "description": "<p>Ups! alguien debio borrar el producto, porfavor recargue la página',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_id_integer",
            "description": "<p>El producto seleccionado no existe, recargue la pagina y pruebe de nuevo',</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "product_id_required",
            "description": "<p>El producto no puede ser nulo',</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-TankNotFoun:",
          "content": "    HTTP/1.1 404 Not found\n{\n \"error\": \"No query results for model [App\\\\Tank].\"\n}",
          "type": "json"
        },
        {
          "title": "Bad-Request:",
          "content": "    HTTP/1.1 400\tBad Request\n{\n \"product_id\": \n [\n   \"Ups! alguien debio borrar el producto, porfavor recargue la página\"\n\t]\n \"status\": \n [\n   \"Seleccione un estatus\"\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "classes/tank.php",
    "groupTitle": "Tank"
  }
] });
