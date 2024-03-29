<?php
/**
 * AttendeesController.php
 */

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Conference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Exception\HttpResponseException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Mail;

/**
  * Controller for the Attendee Model
  *
  * *AttendeesController* is a controller for the Attendee Model, which is the data model for the attendees table.
  *
  */
class AttendeesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
       // $this->middleware('auth:attendee');
    }


   
    /**
     * Function to handle an attendee logging in
     * @param Request $request 
     * Takes POST request
     * 
     * @return type
     * Returns a user token in the form of JSON data
     * @todo Add checks for when user logs in with a remember token
     */
    public function login(Request $request) {
		 
        // set the remember me cookie if the user check the box
        $remember = $request->input('remember') === null ? false : $request->input('remember');
        //echo $remember;
        
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($token = Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('attendee')->user();
            //return redirect()->intended('dashboard');
            return response()->json(compact('user', 'token'));
        }

        //$credentials = $request->only('email', 'password');

		
       //  try
       // {
            //$auth = Attendee();
            //return response()->json(['test' => getenv("JWT_SECRET")], 200);
            //return response()->json(['test' => Auth::guard('attendee')->user()], 200);
        //     if ($remember)
        //     {
        //         //Set token expiration to 1 day
        //         Auth::factory()->setTTL(1440);
        //     }
            
        //     else
        //     {
        //         //Set token expiration to 1 hour
        //         Auth::factory()->setTTL(60);
		// //return response()->json(['test' => 'function entered'], 200);		
        //     }
            
        //     //return response()->json(['test' => 'function entered'], 200);
			
        //         // attempt to verify the credentials and create a token for the user
        //     if (! $token = Auth::attempt($credentials)) 
        //     {
        //         return response()->json(['error' => 'invalid_credentials'], 401);
        //     }
           //return response()->json(['test' => 'function entered'], 200);

      //  }
        // catch (Exception $e)
        // {
        //     // something went wrong whilst attempting to encode the token
        //     return response()->json(['error' => 'could_not_create_token'], 500);
        // }
        
		
		
        //$user = Auth::user();
        //$user = Auth::guard('attendee')->user(); //authenticate user with successfully generated token
        
        
        
        // all good so return the token and user credentials
        //return response()->json(compact('user','token'));
        //return response()->json($payload);
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    /**
     * registers a new attendee account for the user
     * @param Request $request
     * @return type
     */
    public function register(Request $request){
        $regex = '/(?=.*[0-9])(?=.*[A-Z])(?=.*).{8,}/'; //at least 8 characters including at least 1 Uppercase and 1 digit required
        $result = $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:' . $regex,
        ]);


        //TODO: Refactor Error Validation
        // if (isset($result->error))
        // {
        //     return response()->json([
        //         'error'=> [
        //             'message' => 'Verification Failed',
        //             'result' => $result->error
        //         ]
        //     ], IlluminateResponse::HTTP_BAD_REQUEST);
        // }

        $attendee_into = $request->only(
            'name',
            'email',
            'password'
        );

        if (Attendee::where('email', $attendee_into['email'])->count() > 0)
        {
            // Email Exist
            return response()->json([
                'error'=> [
                    'message' => 'Email already in use',
                ]
            ], 409 );
        }

        $attendee_into['password'] = Hash::make($attendee_into['password']);
        $attendee = Attendee::create($attendee_into);
        //$attendee->find($attendee->attendee_id)->conferences()->attach($request->input('conference_id'), ['created_at'=>$attendee->created_at, 'updated_at'=>$attendee->updated_at]);

        return response()->json($attendee);
    }
    
    /**
     * Allows user to join chosen conference
     * @param type $attendee_id
     * @param type $conference_id
     * @return type
     */
    public function join_conference($attendee_id, $conference_id)
    {
        if ( !$attendee = Attendee::find($attendee_id) )
        {
            return response()->json(array(), 404);
	    }
        
        $attendee->conferences()->attach($conference_id, ['created_at'=>$attendee->created_at, 'updated_at'=>$attendee->updated_at]);
        return response()->json($attendee);
    }

    //GET FUNCTIONS
    /**
     * 
     * @return type
     */
    public function get_all() {

        $all = Attendee::all();

        return response()->json($all);
    }

    //GET BY ID FUNCTION
    /**
     * 
     * @param type $id
     * @return type
     */
    public function get_id($id) {
        if(!$cli = Attendee::find($id))
            return response()->json([], 404);

        return response()->json($cli);
    }

    //Logout
    /**
     * Function to handle attendee logging out
     */
    public function logout(){
        /**
         * invalidate generated token
         */
        Auth::logout();
    }

    //POST FUNCTIONS

/*
     public function register( Request $request){

        $reg = new Attendee;
        $reg->name = $request->input('name');
        $reg->email = $request->input('email');
        $reg->salted_password = $request->input('salted_password');

        $reg->save();
        $reg->find($reg->attendee_id)->conferences()->attach($request->input('conference_id'), ['created_at' => $reg->created_at, 'updated_at' => $reg->updated_at]);

        return response()->json("New attendee added!");
    }
    */



    //CHANGE PASSWORD FUNCTION
    /**
     * 
     * @param type $id
     * @param Request $request
     * @return type
     */
    public function change_password($id, Request $request){
        if(!$pEdit = Attendee::find($id))
            return response()->json([], 404);

        
        $pEdit->password = $request->input('password');

        $pEdit->save();

        return response()->json("Password changed successfully!");
    }


    //DELETE FUNCTIONS
    /**
     * 
     * @param type $id
     * @return type
     */
    public function delete_attendee($id){
        if (!$del  = Attendee::find($id))
            return response()->json([], 404);

        $del->delete();

        return response()->json($del);
    }

    /**
     * Allows user to leave chosen conference
     * @param type $attendee_id
     * @param type $conference_id
     * @return type
     */
    public function leave_conference($attendee_id, $conference_id)
    {
        if ( !$attendee = Attendee::find($attendee_id) )
        {
            return response()->json(array(), 404);
	    }

        if (!Conference::find($conference_id))
		{
			return response()->json(array(), 404);
		}
        
        $attendee->conferences()->detach($conference_id);
        return response()->json($attendee);
    }


        //PUT FUNCTION
    /**
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function edit_attendee(Request $request,$id){
        if (!$edit  = Attendee::find($id))
            return response()->json([], 404);

        $edit->name = $request->input('name');
        $edit->email = $request->input('email');
        $edit->salted_password = $request->input('salted_password');

        $edit->save();
        $edit->conferences()->updateExistingPivot($request->input('conference_id'), ['updated_at' => $edit->updated_at]);


        return response()->json($edit);
    }
    
    /**
     * 
     * @param type $email
     */
    public function forgot_password($email){
       // dd(config("mail"));
        //dd(config("mail.from.address"));
        
        Mail::send(['text' => 'email'], ['email' => $email], function($message) use($email)
        {
            $message->from(config("mail.from.address"), 'Bradley Ramsay');

            $message->to($email)->subject('Forgot Password');
        });
    }


    //GET CONFERENCES FUNCTION
    /**
     * 
     * @param type $id
     * @return type
     */
    public function get_conferences($id){
        if (!$cli = Attendee::find($id))
            return response()->json([], 404);

        return response()->json($cli->conferences);
    }

    

}
