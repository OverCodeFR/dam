<?php

namespace App;

enum FrequencyMomentDayEnum: string
{
    case MATIN = 'Matin';
    case MIDI = 'Midi';
    case APRES_MIDI = 'Après-midi';
    case SOIR = 'Soir';
    case NUIT = 'Nuit';
}
