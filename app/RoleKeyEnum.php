<?php

namespace App;

enum RoleKeyEnum: string
{
    case Admin = 'admin';
    case Healthcare = 'healthcare';
    case Helper = 'helper';
    case patient = 'patient';
}
