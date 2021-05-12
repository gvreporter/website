@extends('base.error')

@section('error::code', '429')
@section('error::desc', 'Hai fatto troppe richieste al server. Aspetta qualche minuto e riprova.')
