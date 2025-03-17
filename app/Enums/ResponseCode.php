<?php

namespace App\Enums;

enum ResponseCode: string
{
    case Ok                         = '20000';
    case TooManyAttempts            = '40001';
    case LoginFailed                = '40002';
    case UserSuspended              = '40003';
    case MissingMandatoryField      = '40004';
    case InvalidFieldFormat         = '40005';
    case InvalidUser                = '40006';
    case InvalidDivision            = '40007';
    case InvalidProduct             = '40008';
    case InvalidSurvey              = '40009';
    case InvalidSchedule            = '40010';
    case InvalidCustomer            = '40011';
    case InvalidVisit               = '40012';
    case InvalidFeasibility         = '40013';
    case InvalidMarketSurvey        = '40014';
    case InvalidRDJobOrder          = '40015';
    case InvalidProductDevelopment  = '40016';
    case InvalidSubdivision         = '40017';
    case InvalidSalesArea           = '40018';
    case InvalidTaJobOrder          = '40019';
    case InvalidTaAppStep           = '40020';
    case InvalidTaApplicatorStep    = '40021';
    case InvalidVerification        = '40022';
    case RequestInProgress          = '40023';
    case InvalidMaterial            = '40024';
    case InvalidProductFormulation  = '40025';
    case InvalidCoatingCost         = '40026';
    case InvalidCoatingSchedule     = '40027';
    case InvalidContact             = '40028';
    case InvalidProvince            = '40029';
    case InvalidCity                = '40030';
    case InvalidSubdistrict         = '40031';
    case AlreadyExists              = '40032';
    case InvalidMsds                = '40033';
    case InvalidTds                 = '40034';
    case InvalidCompositions        = '40035';
    case InvalidPurchaseOrder       = '40036';
    case InvalidCommentType         = '40037';
    case FeasibilityCanceled        = '40038';
    case TaJobOrderCanceled         = '40039';
    case RndJobOrderCanceled        = '40040';
    case InvalidSales               = '40041';
    case NotFound                   = '40400';
    case Unauthorized               = '40100';
    case UnauthorizedHttpHeader     = '40101';
    case UnauthorizedApiKey         = '40102';
    case UnauthorizedSuspended      = '40103';
    case UnauthorizedTimestamp      = '40104';
    case UnauthorizedSignature      = '40105';
    case Forbidden                  = '40300';
    case ValidationError            = '42200';
    case GeneralError               = '50000';
    case ConnectionError            = '50001';

    public function getMessage(): string
    {
        return match ($this) {
            self::Ok => 'OK',
            self::TooManyAttempts => 'Too many attempts',
            self::LoginFailed => 'The provided credentials do not match our records',
            self::UserSuspended => 'Your account has been disabled',
            self::MissingMandatoryField => 'Missing mandatory field',
            self::InvalidFieldFormat => 'Invalid field format',
            self::InvalidUser => 'Invalid user',
            self::InvalidDivision => 'Invalid division',
            self::InvalidProduct => 'Invalid product',
            self::InvalidSurvey => 'Invalid survey',
            self::InvalidSchedule => 'Invalid schedule',
            self::InvalidCustomer => 'Invalid customer',
            self::InvalidVisit => 'Invalid visit',
            self::InvalidFeasibility => 'Invalid feasibility',
            self::InvalidMarketSurvey => 'Invalid market survey',
            self::InvalidRDJobOrder => 'Invalid R&D job order',
            self::InvalidProductDevelopment => 'Invalid product development',
            self::InvalidSubdivision => 'Invalid subdivision',
            self::InvalidSalesArea => 'Invalid sales area',
            self::InvalidTaJobOrder => 'Invalid TA job order',
            self::InvalidTaAppStep => 'Invalid TA application step',
            self::InvalidTaApplicatorStep => 'Invalid TA applicator step',
            self::InvalidVerification => 'Invalid verification',
            self::RequestInProgress => 'Request in progress',
            self::InvalidMaterial => 'Invalid material',
            self::InvalidProductFormulation => 'Invalid product formulation',
            self::InvalidCoatingCost => 'Invalid coating cost',
            self::InvalidCoatingSchedule => 'Invalid coating schedule',
            self::InvalidContact => 'Invalid contact',
            self::InvalidProvince => 'Invalid province',
            self::InvalidCity => 'Invalid city',
            self::InvalidSubdistrict => 'Invalid subdistrict',
            self::AlreadyExists => 'Already exists',
            self::InvalidMsds => 'Invalid MSDS',
            self::InvalidTds => 'Invalid TDS',
            self::InvalidCompositions => 'Invalid compositions',
            self::InvalidPurchaseOrder => 'Invalid purchase order',
            self::InvalidCommentType => 'Invalid type',
            self::FeasibilityCanceled => 'Feasibility canceled',
            self::TaJobOrderCanceled => 'TA job order canceled',
            self::RndJobOrderCanceled => 'Rnd job order canceled',
            self::InvalidSales => 'Invalid sales',
            self::NotFound => 'Not Found',
            self::Unauthorized => 'Unauthorized',
            self::UnauthorizedHttpHeader => 'Unauthorized [HTTP headers]',
            self::UnauthorizedApiKey => 'Unauthorized [API key]',
            self::UnauthorizedSuspended => 'Unauthorized [Suspended]',
            self::UnauthorizedTimestamp => 'Unauthorized [Timestamp]',
            self::UnauthorizedSignature => 'Unauthorized [Signature]',
            self::Forbidden => 'Forbidden',
            self::ValidationError => 'Validation error',
            self::GeneralError => 'General error',
            self::ConnectionError => 'Connection error'
        };
    }

    public function getFullCode(): string
    {
        return $this->getStatusCode() . request()->attributes->get('service_code', '00') . $this->getCaseCode();
    }

    public function getStatusCode(): int
    {
        return (int) substr($this->value, 0, 3);
    }

    public function getCaseCode(): string
    {
        return substr($this->value, 3);
    }
}
