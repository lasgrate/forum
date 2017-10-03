@extends('layouts.error')

@section('title', $exception->getMessage())

@section('message', $exception->getMessage())