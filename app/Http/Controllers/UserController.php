<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//hash
use Illuminate\Support\Facades\Hash;
//auth
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    
    /**
     *
     *  @OA\Post(path="/api/admin/register",
     *     tags={"Usuarios"},
     *     description="Registrar usuario",
     *     summary="Registrar usuario Admin",
     *     operationId="AdminRegister",
     *     @OA\Parameter(
     *         name="Admin",
     *      in="header",
     *      required=true,
     *          description="Admin identifier",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Se ha iniciado sesión conrrectamente",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="access_token",
     *                  type="string",
     *                  description="Bearer token"
     *              ),
     *              @OA\Property(
     *                  property="token_type",
     *                  type="string",
     *                  description="Token type"
     *              ),
     *              @OA\Property(
     *                  property="user",
     *                  type="array",
     *                  description="Datos del usuario",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          description="Id usuario"
     *                      ),
     *              
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="expires_in",
     *                  type="integer",
     *                  description="Duración token"
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Recurso no encontrado. La petición no devuelve ningún dato",
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Acceso denegado. No se cuenta con los privilegios suficientes",
     *         @OA\JsonContent(
     *              @OA\Property(property ="error",type="string",description="Mensaje de error de privilegios insuficientes")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error de Servidor.",
     *         @OA\JsonContent(
     *              @OA\Property(property ="error",type="string",description="Error de Servidor")
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *     description="Datos de usuario para registro",
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             type="object",
     *             required ={"usuario","password"},
     *              @OA\Property(
     *                 property="name",
     *                 description="Nombre de usuario",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 description="Correo de usuario",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 description="Cláve de ingreso al sistema",
     *                 type="string"
     *             ),
     *         )
     *     )
     *  )
     * )
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['Error al ingresar los datos' => $validator->errors()], 422);
        }
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = strtolower($request->email);
            $user->password = Hash::make($request->password);
            $user->save();
            // if ($user->save()) {
            $token = $user->createToken('API Token')->accessToken;
            return response()->json(['token' => $token, 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['Error al crear el usuario' => $e->getMessage()], 500);
        }
    }

      /**
     *
     *  @OA\Post(path="/api/admin/login",
     *     tags={"Autenticar"},
     *     description="Permite autenticarse y devuelve jwt token para autorizar acceso a endpoints protegidos.",
     *     summary="Autenticar usuario Admin",
     *     operationId="autenticar_update",
     *  @OA\Parameter(
     *         name="Admin",
     *      in="header",
     *      required=true,
     *          description="Admin identifier",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Se ha iniciado sesión conrrectamente",
     *         @OA\JsonContent(
     *              type="object",
     *              ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Recurso no encontrado. La petición no devuelve ningún dato",
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Acceso denegado. No se cuenta con los privilegios suficientes",
     *         @OA\JsonContent(
     *              @OA\Property(property ="error",type="string",description="Mensaje de error de privilegios insuficientes")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error de Servidor.",
     *         @OA\JsonContent(
     *              @OA\Property(property ="error",type="string",description="Error de Servidor")
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *     description="Credenciales de ingreso",
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             type="object",
     *             required ={"usuario","password"},
     *             @OA\Property(
     *                 property="email",
     *                 description="Número de teléfono",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 description="Cláve de ingreso al sistema",
     *                 type="string"
     *             ),
     *         )
     *     )
     *  )
     * )
     */


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['Error al ingresar los datos' => $validator->errors()], 422);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('API Token')->accessToken;

        return response()->json(['token' => $token], 200);
    }
}
