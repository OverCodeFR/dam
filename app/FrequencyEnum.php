<?php

namespace App;

enum FrequencyEnum: string
{
    // Prise quotidienne
    case UNE_FOIS_PAR_JOUR = '1/jour';
    case DEUX_FOIS_PAR_JOUR = '2/jour';
    case TROIS_FOIS_PAR_JOUR = '3/jour';
    case QUATRE_FOIS_PAR_JOUR = '4/jour';
    case CINQ_FOIS_PAR_JOUR = '5/jour';

    // Prise hebdomadaire
    case UNE_FOIS_PAR_SEMAINE = '1/semaine';
    case DEUX_FOIS_PAR_SEMAINE = '2/semaine';
    case TROIS_FOIS_PAR_SEMAINE = '3/semaine';

    // Prise mensuelle
    case UNE_FOIS_PAR_MOIS = '1/mois';
    case DEUX_FOIS_PAR_MOIS = '2/mois';

    // Autres
    case TOUS_LES_DEUX_JOURS = '1/2jours';
    case TOUS_LES_TROIS_JOURS = '1/3jours';
    case TOUS_LES_SIX_HEURES = '1/6h';
    case A_LA_DEMANDE = 'à la demande';
    case UNIQUE = 'ponctuel';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
