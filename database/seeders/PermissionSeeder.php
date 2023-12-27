<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Dashboard',
            'Dashboard Sale',
            'Customer List',
            'Customer Create',
            'Customer Edit',
            'Customer Delete',
            'Staff List',
            'Staff Create',
            'Staff Edit',
            'Staff Delete',
            'Position List',
            'Position Create',
            'Position Edit',
            'Position Delete',
            'Department List',
            'Department Create',
            'Department Edit',
            'Department Delete',
            'WorkPlace List',
            'WorkPlace Create',
            'WorkPlace Edit',
            'WorkPlace Delete',
            'Payroll List',
            'Payroll Create',
            'Payroll Edit',
            'Payroll Delete',
            'Attandance List',
            'Attandance Create',
            'Attandance Edit',
            'Attandance Delete',
            'Quote List',
            'Quote Create',
            'Quote Edit',
            'Quote Delete',
            'Sale List',
            'Sale Create',
            'Sale Edit',
            'Sale Delete',
            'Product Category List',
            'Product Category Create',
            'Product Category Edit',
            'Product Category Delete',
            'Product Sub Category List',
            'Product Sub Category Create',
            'Product Sub Category Edit',
            'Product Sub Category Delete',
            'Product List',
            'Product Create',
            'Product Edit',
            'Product Delete',
            'Item Group List',
            'Item Group Create',
            'Item Group Edit',
            'Item Group Delete',
            'Item Sub Group List',
            'Item Sub Group Create',
            'Item Sub Group Edit',
            'Item Sub Group Delete',
            'Item List',
            'Item Create',
            'Item Edit',
            'Item Delete',
            'Item Adjustment List',
            'Item Adjustment Create',
            'Item Adjustment Edit',
            'Item Adjustment Delete',
            'Revenue List',
            'Revenue Create',
            'Revenue Edit',
            'Revenue Delete',
            'Expend List',
            'Expend Create',
            'Expend Edit',
            'Expend Delete',
            'User List',
            'User Create',
            'User Edit',
            'User Delete',
            'Role List',
            'Role Create',
            'Role Edit',
            'Role Delete',
            'Option Income List',
            'Option Income Create',
            'Option Income Edit',
            'Option Income Delete',
            'Option Expend List',
            'Option Expend Create',
            'Option Expend Edit',
            'Option Expend Delete',
            'Time List',
            'Time Create',
            'Time Edit',
            'Time Delete',
            'System Profile List',
            'System Profile Create',
            'System Profile Edit',
            'System Profile Delete',
            'About List',
            'About Create',
            'About Edit',
            'About Delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
