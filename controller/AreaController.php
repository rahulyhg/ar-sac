<?php

require_once './model/Area.php';

class AreaController {

    public static function get_areas() {
        $respuesta = new stdClass();
        $respuesta->areas = Area::all();
        if (count($respuesta->areas) == 0) {
            $respuesta->result = false;
            $respuesta->mensaje = "No hay áreas registradas.";
        }
        return $respuesta;
    }

    public static function get_preguntas_area($id) {
        $respuesta = new stdClass();
        $area = Area::find($id);
        if ($area) {
            $respuesta->preguntas = $area->preguntas;
            if (count($respuesta->preguntas) == 0) {
                $respuesta->result = false;
                $respuesta->mensaje = "No hay preguntas registradas para el área con código '$id'.";
            }
        } else {
            $respuesta->result = false;
            $respuesta->mensaje = "El área con código '$id' no se encuentra registrada.";
        }

        return $respuesta;
    }

    public static function post_areas($recibido) {
        $area = new Area();
        $area->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $area->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Área registrada correctamente.";
            $respuesta->area = $area;
        } else {
            $respuesta->mensaje = "No se pudo registrar el área.";
        }
        return $respuesta;
    }
    
    public static function delete_area($codarea) {
        $area = Area::find($codarea);
        $respuesta = new stdClass();
        if ($area) {
            $respuesta->result = $area->delete();
            if ($area->trashed()) {
                $respuesta->mensaje = "Eliminado correctamente.";
                $respuesta->area = $area;
            } else {
                $respuesta->mensaje = "Error tratando de eliminar.";
            }
        } else {
            $respuesta->mensaje = "No se encuentra registrado.";
        }
        return $respuesta;
    }
    
    public static function put_area($codarea, $recibido) {
        $area = Area::find($codarea);
        $area->add_data($recibido);
        $respuesta = new stdClass();
        $respuesta->result = $area->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Actualizado correctamente.";
            $respuesta->area = $area;
        } else {
            $respuesta->mensaje = "Error al momento de actualizar.";
        }
        return $respuesta;
    }
     
}
