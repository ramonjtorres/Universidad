package com.monkeybit.routability;

import com.android.volley.Response;

import org.json.JSONObject;

/* Simplemente para simplificar el uso de la base de datos */
public interface DBConnectInterface extends  Response.Listener<JSONObject>, Response.ErrorListener {}
