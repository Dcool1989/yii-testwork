<?php

namespace app\repository;
use app\entity\Staff;


class StaffRepository
{
    public static function getStaffs()
    {
        return Staff::find()->all();
    }



    public static function createStaff($surname, $name, $patronymic, $post)
    {
        $staff = new Staff();
        $staff->surname=$surname;
        $staff->name=$name;
        $staff->patronymic=$patronymic;
        $staff->post=$post;
        $staff->save();
        return $staff->id;
    }

    public static function getStaffById($staff_id) {
        return Staff::find()->where(['id'=>$staff_id])->one();
    }


}