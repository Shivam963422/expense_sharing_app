<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

    public $table = 'expense';

    public $fillable = ['expense_reason', 'amount','created_by'];

}
