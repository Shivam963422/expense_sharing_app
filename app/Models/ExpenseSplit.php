<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseSplit extends Model {

    public $table = 'expense_split';

    public $fillable = ['expense_id', 'borrower_id','paid_by','due_amount','split_type'];

}
