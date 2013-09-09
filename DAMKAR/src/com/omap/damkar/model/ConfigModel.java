package com.omap.damkar.model;

import java.util.ArrayList;
import java.util.HashMap;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

import com.omap.damkar.config.Config;

public class ConfigModel {

	private DataBaseHelper dbh;
	private String[] SELECT_OM_CONFIG = { "id", "phone_number" };

	public ConfigModel(Context context) {
		dbh = new DataBaseHelper(context);
	}

	public long add(String phone_number) {
		SQLiteDatabase db = dbh.getWritableDatabase();
		ContentValues datas = new ContentValues();
		datas.put("phone_number", phone_number);
		Log.i(Config.LOGGING, "INSERT DATA");
		return db.insertOrThrow(Config.DB_TABLE_CONFIG, null, datas);
	}

	public void update(String id, String phone_number) {
		SQLiteDatabase db = dbh.getWritableDatabase();
		ContentValues datas = new ContentValues();
		datas.put("phone_number", phone_number);
		db.update(Config.DB_TABLE_CONFIG, datas, "id=" + id, null);
		Log.i(Config.LOGGING, "UPDATE DATA");
	}

	public ArrayList<HashMap<String, String>> show() {
		ArrayList<HashMap<String, String>> mylist = new ArrayList<HashMap<String, String>>();
		SQLiteDatabase db = dbh.getReadableDatabase();
		Cursor cursor = db.query(Config.DB_TABLE_CONFIG, SELECT_OM_CONFIG, null, null, null, null, null);
		while (cursor.moveToNext()) {
			HashMap<String, String> map = new HashMap<String, String>();
			String id = cursor.getString((cursor.getColumnIndex("id")));
			String phone_number = cursor.getString((cursor.getColumnIndex("phone_number")));

			map.put("id", id);
			map.put("phone_number", phone_number);
			mylist.add(map);
		}
		return mylist;
	}

	public void delete(Integer id) {
		SQLiteDatabase db = dbh.getWritableDatabase();
		db.delete(Config.DB_TABLE_CONFIG, "id=" + id, null);
	}

	public void delete_all() {
		SQLiteDatabase db = dbh.getWritableDatabase();
		db.delete(Config.DB_TABLE_CONFIG, null, null);
	}
}