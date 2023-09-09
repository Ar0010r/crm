<?php

namespace App\Domain\Enums;

use App\Domain\Models\User;

class Status
{
    public const WAITING_AGREEMENT = 'Waiting agreement';
    public const NEW = 'New';
    public const READY = 'Ready';
    public const NEED_DATA = 'Need data';
    public const INFO = 'Info';
    public const BAD = 'Bad';
    public const NOT_USA = 'Not USA';
    public const SCAM = 'Scam';
    public const DIED = 'Died';

    public const INVITED = 'Invited';
    public const EXPORTED = 'Exported';

    private const WHITE_COLOR_STYLE = 'btn-white';
    private const BLUE_COLOR_STYLE = 'btn-primary';
    private const OCEAN_COLOR_STYLE = 'btn-info';
    private const YELLOW_COLOR_STYLE = 'btn-warning';
    private const RED_COLOR_STYLE = 'btn-danger';
    private const GREEN_COLOR_STYLE = 'btn-success';
    private const GREY_COLOR_STYLE = 'btn-secondary';
    private const BLACK_COLOR_STYLE = 'btn-dark';

    public const STATUSES = [
        self::NEED_DATA,
        self::READY,
        self::INVITED,
        self::EXPORTED,
        self::BAD,
        self::SCAM,
        self::NOT_USA,
        self::DIED
    ];

    public const ALL_STATUSES = [
        self::NEED_DATA => self::WHITE_COLOR_STYLE,
        self::BAD => self::RED_COLOR_STYLE,
        self::NOT_USA => self::RED_COLOR_STYLE,
        self::SCAM => self::RED_COLOR_STYLE,
        self::READY => self::OCEAN_COLOR_STYLE,
        self::DIED => self::BLACK_COLOR_STYLE,
        self::INVITED => self::BLUE_COLOR_STYLE,
        self::EXPORTED => self::GREEN_COLOR_STYLE,
    ];

    public const HR_STATUSES = [
        self::NEED_DATA => self::WHITE_COLOR_STYLE,
        self::READY => self::OCEAN_COLOR_STYLE,
       // self::INVITED => self::BLUE_COLOR_STYLE,
        self::BAD => self::RED_COLOR_STYLE,
        self::NOT_USA => self::RED_COLOR_STYLE,
        self::SCAM => self::RED_COLOR_STYLE,
    ];

    public const PERSONNEL_STATUSES = [
        self::READY => self::OCEAN_COLOR_STYLE,
        self::INVITED => self::BLUE_COLOR_STYLE,
        self::DIED => self::BLACK_COLOR_STYLE,
        self::EXPORTED => self::GREEN_COLOR_STYLE,
    ];

    public static function getAvailableRoles(User $user = null): array
    {
        $user = $user ?? auth()->user();

        switch ($user->role) {
            case Role::PERSONNEL:
                return self::PERSONNEL_STATUSES;
            case Role::ADMIN:
                return self::ALL_STATUSES;
            default:
                return self::HR_STATUSES;
        }
    }
}
