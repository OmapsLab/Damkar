package com.omap.damkar.model;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.omap.damkar.config.Config;

public class DataBaseHelper extends SQLiteOpenHelper {

	private static final String MYDATABASE = Config.DB_NAME;
	private static final int VERSION = 1;

	public DataBaseHelper(Context connection) {
		super(connection, MYDATABASE, null, VERSION);
	}

	@Override
	public void onCreate(SQLiteDatabase db) {
		db.execSQL("CREATE TABLE " + Config.DB_TABLE_CONFIG + "(id INTEGER PRIMARY KEY AUTOINCREMENT,  phone_number TEXT);");
	}

	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
		db.execSQL("DROP TABLE IF EXIST "+ Config.DB_TABLE_CONFIG);
		onCreate(db);
	}

}