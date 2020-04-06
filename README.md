# AComer - Backend 

Rest API  


#### Notas  

Creando migrations: Modelado de la base de datos. 

```
> php artisan make:migration create_nombre_table 
```

Creando seeders: Insertando datos de prueba en una base de datos. 

```
> php artisan make:seeder NombreSeeder 
```

Creando models: Son los modelos que manejaremos en php para realizar consultas y relaciones. 

```
> php artisan make:model Models/Nombre
```

Creando los controllers: Nos serviran para las peticiones realizadas en los servicios. 

```
> php artisan make:controller api/v1/NombreController --api
```

Creando un resources: Estos nos funcionan para mapear en un JSON el objeto. 
```
> // Este solo nos sirve para mapear un objeto
> php artisan make:resource NombreResource 
> // Este nos sirve para mapear muchos objetos podemos usar el Resource dentro de este 
> php artisan make:resource NombreCollection
```

En todos los resources de tipo collection debe utilizar el trait NewCollectionResponse. 
```php
use NewCollectionResponse; 
// En la funcion toArray se debe utilizar el metodo newCollectionResponse 

public function toArray($request)
{
    return $this->newCollectionResponse(
        NombreResource::collection($this->collection)
    );
}
```

Definir solo rutas para api: 

```php
Route::apiResource('', '');
```

Migrar todos los modelos a la base de datos  
```
> php artisan migrate
```

Creamos request: Son las resonsables de manejar los formularios, aqui programaremos toda la logia para un store o un update. 

```
> php artisan make:request Nombre<Accion>Request
> // Acciones : Create | Update 
```

En todos nuestros request debemos utilizar el trait de FalidValidation. Solo debemos escribir el siguiente codigo en las clases request. 
```php
use FailedValidation; 
```

Creamos factories: Estos nos ayudaran a poblar nuestra base de datos, generando datos de prueba. 
```
> php artisan make:factory NombreFactory 
```

Ejecutamos los seeders, para poblar nuestra bd. 
```
> php artisan migrate:refresh 
> composer dump-autoload
> php artisa db:seed 
``` 

### Ejemplos 

Una buen ejemplo del poder de Eloquent 
```php
$users = User::select([
    'users.*',
    'last_posted_at' => Post::selectRaw('MAX(created_at)')
            ->whereColumn('user_id', 'users.id')
])->withCasts([
    'last_posted_at' => 'date'
])->get();
```

Cast para ser usados en las respuestas JSON esto se le agrega en el modelo. 
```php
protected $casts = [
    'birthday' => 'date:Y-m-d',
    'joined_at' => 'datetime:Y-m-d H:00',
];
```

Ejemplo de una foreignkey. 
```php
$table->foreign('profession_id')->references('id')->on('professions');
```

Obtenemos los objetos eliminados. 
```php
$res = Restaurante::withTrashed()
            ->where('id', $id)
            ->get();
```

Activamos los objetos eliminados. 
```php
$res = Restaurante::withTrashed()
            ->where('id', $id)
            ->restore();
```

Ejemplos de querys. 
```php 
return Cliente::select([
    'id',
    'nombre',
    'apellido',
    'extra' => Cliente::selectRaw('MAX(created_at)')
        ->whereColumn('id', 'clientes.id')
])->get();

return Cliente::with(['favoritos.plato:id,url_imagen', 'sugerencias'])->get();
return Cliente::with(['facturas.pedido.mesa'])->get();
return Cliente::with(['facturas.pedido:id,platos'])->get();
return Cliente::paginate(30);
```
