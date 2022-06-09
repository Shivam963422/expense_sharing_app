<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expense;
use App\Models\ExpenseSplit;
use Validator;
use DB;
use Illuminate\Support\Facades\Schema;
use Auth;

class UserController extends Controller
{
  
    public function __construct()
    {
      $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }   

    //--------------------------------------------------------------------------------

    public function availableUsers()
    {


      $userId = auth()->user()->id;

      $result = User::where('id' ,'!=', $userId)->get();


       if(!$result->isEmpty())
     {

      $resData = [];

       foreach ($result as $key => $value) {

            $resData[] = [
                  'userId' => $value->id ?? "",
                  'name' => $value->name ?? "",
                  'email' => $value->email ?? "",
                  'mobile_number'=> $value->mobile_number ?? "",
                  'created_at' => $value->created_at->format('Y-m-d H-m-s') ?? "",
            ];
        }

      return response()->json([
                    'status' => 1,
                    'message' => 'Available Users!',
                    'data' => $resData
                        ], 201);

     }

    }

    //---------------------------------------------------------------------------------

    public function createExpense(Request $request)
    {
      
       $validator = Validator::make(
                        $request->all(), [

                    'expense_reason' => 'required|max:55',
                    "amount" => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    
                        ]
        );

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                        'status' => 0,
                        'errors' => $messages,
                        'message' => "Unable to create"
            ]);
        }

       $userId = auth()->user()->id;

       $result = Expense::create(["expense_reason" => $request->expense_reason, "amount" => $request->amount,"created_by" => $userId]);


        if (!$result) {
            return response()->json([
                        'status' => 0,
                        'message' => 'Unable To Create Expense',
            ]);
        }
        return response()->json([
                    'status' => 1,
                    'message' => 'Expense Created Sucessfully',
                    'data' => $result
                        ], 201);
    }

    //-------------------------------------------------------------------------------

    public function userExpensesList()
    {

        $my_id = auth()->user()->id;

        $data = DB::table('users')
                ->leftjoin('expense', 'users.id', '=', 'expense.created_by')
                ->where('users.id', '=', $my_id)
                ->orderBy('expense.id')
                ->select('expense.id as expenseId' , 'expense.expense_reason', 'expense.amount'
                    ,'expense.created_at')
                ->get()
                ->toArray();
        if (count($data)) {
            return response()->json([
                        'status' => 1,
                        'data' => $data
            ]);
        }
        return response()->json([
                    'status' => 0,
                    'message' => 'Expenses not found'
                        ], 201);

    }

    //------------------------------------------------------------------------------

    public function splitExpenses(Request $request)
    {

        $validator = Validator::make(
                        $request->all(), [
                    'split_type' => "required|in:equal,exact,percentage",
                     ]
        );

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                        'status' => 0,
                        'errors' => $messages,
                        'message' => "Unable to create"
            ]);
        }


        if($request->split_type == 'equal')
        {

            $validator = Validator::make(
                        $request->all(), [

                    'expense_id' => 'required|exists:expense,id',
                    'borrower_ids' => 'required|array',
                     ]
        );

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                        'status' => 0,
                        'errors' => $messages,
                        'message' => "Unable to create"
            ]);
        }

        $expense_split_check = ExpenseSplit::where('expense_id' ,'=', $request->expense_id)->get();


        if(!$expense_split_check->isEmpty())
        {

            return response()->json([
                        'status' => 0,
                        'message' => "This expense is alreday been splitted!"
            ]);
            
        }

        $my_id = auth()->user()->id;

        $expense_details = Expense::find($request->expense_id);

        $expense_amount = (float)$expense_details['amount'];
 
        $borrower_ids = $request->borrower_ids;

        $total_splits_no = count($borrower_ids) + 1;

        $avg_amount = $expense_amount/$total_splits_no;

        $due_amount = round($avg_amount,2);

        $no_of_borrowers = count($borrower_ids);

        if($no_of_borrowers > 1)
        {
           foreach ($borrower_ids as $key => $borrower_id) {

           if($key == 0)
           {
              $cal = $expense_amount*0.0001;

              $calc = round($cal,2);
              
             $result = ExpenseSplit::create(["expense_id" => $request->expense_id, 
                "borrower_id" => $borrower_id,"paid_by" => $my_id,
                "due_amount" => $due_amount+$calc,"split_type"=>$request->split_type ]);
           }
           else
           {
             $result = ExpenseSplit::create(["expense_id" => $request->expense_id, 
                "borrower_id" => $borrower_id,"paid_by" => $my_id,
                "due_amount" => $due_amount,"split_type"=>$request->split_type ]);
           } 

        }

        return response()->json([
                    'status' => 1,
                    'message' => 'Split Created Sucessfully',
                        ], 201);

        }

        foreach ($borrower_ids as $key => $borrower_id) {

            $result = ExpenseSplit::create(["expense_id" => $request->expense_id, 
                "borrower_id" => $borrower_id,"paid_by" => $my_id,
                "due_amount" => $due_amount,"split_type"=>$request->split_type ]);

        }

        return response()->json([
                    'status' => 1,
                    'message' => 'Split Created Sucessfully',
                        ], 201);


        }
        elseif($request->split_type == 'exact') 
        {

            $validator = Validator::make(
                        $request->all(), [

                    'expense_id' => 'required|exists:expense,id',
                    'borrower_ids' => 'required|array',
                    'amounts'=>'required|array',
                     ]
        );

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                        'status' => 0,
                        'errors' => $messages,
                        'message' => "Unable to create"
            ]);
        }

        $expense_split_check = ExpenseSplit::where('expense_id' ,'=', $request->expense_id)->get();


        if(!$expense_split_check->isEmpty())
        {

            return response()->json([
                        'status' => 0,
                        'message' => "This expense is alreday been splitted!"
            ]);
            
        }

        $my_id = auth()->user()->id;

        $expense_details = Expense::find($request->expense_id);

        $expense_amount = (float)$expense_details['amount'];
 
        $borrower_ids = $request->borrower_ids;

        $amounts_divided = $request->amounts;

        array_sum($amounts_divided);

        if(array_sum($amounts_divided) != $expense_amount)
        {
            return response()->json([
                        'status' => 0,
                        'message' => "Please Enter Correct Amounts!"
            ]);
        }


        $borrower_ids_count = count($borrower_ids);


        $amounts_divided_count = count($amounts_divided);

        
        if($borrower_ids_count == $amounts_divided_count)
        {

            for($i =0 ;$i<=$borrower_ids_count-1 ;$i++)
           {

               $result = ExpenseSplit::create(["expense_id" => $request->expense_id, 
                "borrower_id" => $borrower_ids[$i],"paid_by" => $my_id,
                "due_amount" => $amounts_divided[$i],"split_type"=>$request->split_type ]);
           } 



        return response()->json([
                    'status' => 1,
                    'message' => 'Split Created Sucessfully',
                        ], 201);

        } 

        return response()->json([
                        'status' => 0,
                        'message' => "Please Assign the users with amount correctly!"
            ]);

        
            
        }
        elseif($request->split_type == 'percentage')
        {

        $validator = Validator::make(
                        $request->all(), [

                    'expense_id' => 'required|exists:expense,id',
                    'borrower_ids' => 'required|array',
                    'percentage'=>'required|array',
                     ]
        );

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                        'status' => 0,
                        'errors' => $messages,
                        'message' => "Unable to create"
            ]);
        }


        $expense_split_check = ExpenseSplit::where('expense_id' ,'=', $request->expense_id)->get();


        if(!$expense_split_check->isEmpty())
        {

            return response()->json([
                        'status' => 0,
                        'message' => "This expense is alreday been splitted!"
            ]);
            
        }

        $my_id = auth()->user()->id;

        $expense_details = Expense::find($request->expense_id);

        $expense_amount = (float)$expense_details['amount'];
 
        $borrower_ids = $request->borrower_ids;

        $percentage_divided = $request->percentage;

        if(array_sum($percentage_divided) > 100)
        {
            return response()->json([
                        'status' => 0,
                        'message' => "Please Enter Correct Percentage Data!"
            ]);
        }


        $borrower_ids_count = count($borrower_ids);


        $percentage_count = count($percentage_divided);

        if($borrower_ids_count == $percentage_count)
        {

          $amount_split = [];

          for($i=0;$i<=$borrower_ids_count-1;$i++)
          {

            $calc = $expense_amount*$percentage_divided[$i];

            $calc1 = (float) $calc/100; 

            $splitted_amount = round($calc1,2);

            $amount_split[$i] = $splitted_amount;

          }


          for($i =0 ;$i<=$borrower_ids_count-1 ;$i++)
            {

                   $result = ExpenseSplit::create(["expense_id" => $request->expense_id, 
                    "borrower_id" => $borrower_ids[$i],"paid_by" => $my_id,
                    "due_amount" => $amount_split[$i],"split_type"=>$request->split_type ]);
            }

            return response()->json([
                    'status' => 1,
                    'message' => 'Split Created Sucessfully',
                        ], 201);

        }

        return response()->json([
                    'status' => 1,
                    'message' => 'Split Created Sucessfully',
                        ], 201);
        }    

    }

    //----------------------------------------------------------------------------------------------


    public function userDueSheet()
    {
        $my_id = auth()->user()->id;


        $result = ExpenseSplit::where('borrower_id' ,'=', $my_id)->get();

        if($result->isEmpty())
        {

            return response()->json([
                        'status' => 0,
                        'message' => "No Due History Found!"
            ]);
            
        }


        $data = DB::table('expense_split')
                ->leftjoin('expense','expense.id','=','expense_split.expense_id')
                ->leftjoin('users','users.id','=','expense.created_by')
                ->where('expense_split.borrower_id','=', $my_id)
                ->select('expense_split.due_amount','expense_split.split_type','expense_split.created_at',
                    'expense.expense_reason','users.name as paidBy','users.email','users.mobile_number','users.id as paidByUserId')
                ->orderBy('expense_split.created_at', 'DESC')
                ->get()
                ->toArray();

        if (count($data)) {
            return response()->json([
                        'status' => 1,
                        'data' => $data
            ]);
        }
        return response()->json([
                    'status' => 0,
                    'message' => 'No Due History Found!'
                        ], 201);

    }

    //----------------------------------------------------------------------------------------------

    public function userPaidSheet()
    {


        $my_id = auth()->user()->id;


        $result = ExpenseSplit::where('paid_by' ,'=', $my_id)->get();

        if($result->isEmpty())
        {

            return response()->json([
                        'status' => 0,
                        'message' => "No Paid History Found!"
            ]);
            
        }


        $data = DB::table('expense')
                ->leftjoin('expense_split','expense_split.expense_id','=','expense.id')
                ->leftjoin('users','users.id','=','expense_split.borrower_id')
                ->where('expense.created_by','=', $my_id)
                ->select('expense_split.due_amount','expense_split.split_type','expense_split.created_at',
                    'expense.expense_reason','users.name as dueUserName','users.email','users.mobile_number','users.id as dueUserId')
                ->orderBy('expense.created_at', 'DESC')
                ->get()
                ->toArray();

        if (count($data)) {
            return response()->json([
                        'status' => 1,
                        'data' => $data
            ]);
        }
        return response()->json([
                    'status' => 0,
                    'message' => 'No Due History Found!'
                        ], 201);

    }

    //------------------------------------------------------------------------------------------------

    public function checkBalanceRespectiveToUser(Request $request)
    {

         $validator = Validator::make(
                        $request->all(), [

                    "userId" => 'required|exists:users,id',
                    
                        ]
        );

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                        'status' => 0,
                        'errors' => $messages,
                        'message' => "Unable to create"
            ]);
        }

        $my_id = auth()->user()->id;

        $userId = $request->userId;


        $data_balance = DB::table('expense_split')
                ->where('expense_split.borrower_id','=', $my_id)
                ->where('expense_split.paid_by','=', $userId)
                ->select('expense_split.due_amount')
                ->get()
                ->toArray();


        $resData =[];

        foreach ($data_balance as $key => $value) {

           $resData[$key] = (float)$value->due_amount;

        }

        $due_balance = array_sum($resData);

        $data_paid = DB::table('expense_split')
                ->where('expense_split.borrower_id','=', $userId)
                ->where('expense_split.paid_by','=', $my_id)
                ->select('expense_split.due_amount')
                ->get()
                ->toArray();


        $val = [];

        foreach ($data_paid as $key => $value) {

           $val[$key] = (float)$value->due_amount;

        }

        $paid_balance = array_sum($val);

        if($paid_balance > $due_balance)
        {

            $diff = $paid_balance - $due_balance;

            return response()->json([
                        'status' => 1,
                        'amount_user_should_pay' => $diff
            ]);


        }
        else
        {
            $diff = $due_balance - $paid_balance;

            return response()->json([
                        'status' => 1,
                        'amount_you_should_pay' => $diff
            ]);

        }    

    }


}
//end of class
//end of file





