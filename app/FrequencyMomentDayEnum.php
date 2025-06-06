<?php

namespace App;

enum FrequencyMomentDayEnum: string
{
    case MATIN = 'matin';
    case MIDI = 'midi';
    case APRES_MIDI = 'après_midi';
    case SOIR = 'soir';
    case NUIT = 'nuit';

    case MATIN_MIDI = 'matin/midi';
    case MATIN_APRES_MIDI = 'matin/après_midi';
    case MATIN_SOIR = 'matin/soir';
    case MATIN_NUIT = 'matin/nuit';

    case MIDI_APRES_MIDI = 'midi/après_midi';
    case MIDI_SOIR = 'midi/soir';
    case MIDI_NUIT = 'midi/nuit';

    case APRES_MIDI_SOIR = 'après_midi/soir';
    case APRES_MIDI_NUIT = 'après_midi/nuit';
    case SOIR_NUIT = 'soir/nuit';

    case MATIN_MIDI_APRES_MIDI = 'matin/midi/après_midi';
    case MATIN_MIDI_SOIR = 'matin/midi/soir';
    case MATIN_MIDI_NUIT = 'matin/midi/nuit';
    case MATIN_APRES_MIDI_SOIR = 'matin/après_midi/soir';
    case MATIN_APRES_MIDI_NUIT = 'matin/après_midi/nuit';
    case MATIN_SOIR_NUIT = 'matin/soir/nuit';

    case MIDI_APRES_MIDI_SOIR = 'midi/après_midi/soir';
    case MIDI_APRES_MIDI_NUIT = 'midi/après_midi/nuit';
    case MIDI_SOIR_NUIT = 'midi/soir/nuit';
    case APRES_MIDI_SOIR_NUIT = 'après_midi/soir/nuit';

    case MATIN_MIDI_APRES_MIDI_SOIR = 'matin/midi/après_midi/soir';
    case MATIN_MIDI_APRES_MIDI_NUIT = 'matin/midi/après_midi/nuit';
    case MATIN_MIDI_SOIR_NUIT = 'matin/midi/soir/nuit';
    case MATIN_APRES_MIDI_SOIR_NUIT = 'matin/après_midi/soir/nuit';
    case MIDI_APRES_MIDI_SOIR_NUIT = 'midi/après_midi/soir/nuit';

    case MATIN_MIDI_APRES_MIDI_SOIR_NUIT = 'matin/midi/après_midi/soir/nuit';
}
