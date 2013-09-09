package com.omap.damkar;

import org.json.JSONArray;
import org.json.JSONException;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.actionbarsherlock.app.SherlockActivity;
import com.omap.damkar.model.ConfigModel;

public class Setting extends SherlockActivity {

	final Context context = this;
	private Button button;
	ConfigModel model;
	EditText phone_number;
	String configModel_id;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		setTitle("Setting");
		super.onCreate(savedInstanceState);
		setContentView(R.layout.setting);
		button = (Button) findViewById(R.id.savephonenumber);
		phone_number = (EditText) findViewById(R.id.phonenumber);
		

		// Prepare database model
		model = new ConfigModel(getApplicationContext());

		try {
			System.out.println("PHONE NUMBER => " + model.show().toString());
			JSONArray jar = new JSONArray(model.show().toString());
			if (jar.length() != 0) {
				String get_phone_number = jar.getJSONObject(0).getString("phone_number").substring(3);
				configModel_id = jar.getJSONObject(0).getString("id");
				phone_number.setText(get_phone_number);
			}

		} catch (JSONException e) {
			e.printStackTrace();
		}
		
		System.out.println("CONFIG_MODEL_ID " + configModel_id);

		button.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View arg0) {
				String getPhoneNumber = "hp_" + phone_number.getText().toString();

				if (getPhoneNumber.equals("")) {
					Toast.makeText(getApplicationContext(), "Field Masih kosong..!!", Toast.LENGTH_LONG).show();
				} else {
					if (configModel_id != null) {
						model.update(configModel_id, getPhoneNumber);
						Toast.makeText(getApplicationContext(), "Phone Number berhasil di update", Toast.LENGTH_LONG).show();
					} else {
						model.add(getPhoneNumber);
						Toast.makeText(getApplicationContext(), "Phone Number berhasil di simpan", Toast.LENGTH_LONG).show();
					}
					
				}

			}

		});

	}

	@Override
	public void onBackPressed() {
		Intent intent = new Intent(getApplicationContext(), MainMenu.class);
		startActivity(intent);
		finish();
	}
}
