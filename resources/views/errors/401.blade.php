@extends('base.error')

@section('error::code', '401')
@section('error::desc', $message ?? 'Non sei autorizzato a vedere questa pagina.')
