package com.monkeybit.routability;

import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.auth.UserInfo;


public class UserProfileActivity extends Fragment implements AlertDialogResponseInterface {
    private FirebaseAuth mAuth;
    FirebaseUser currentUser;
    TextView emailText;
    TextView nameText;
    Button logOut;
    Button deleteAccount;
    Button btChange;
    Button suggestPlace;
    Button suggestRoute;


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_user_profile, container, false);
        mAuth = FirebaseAuth.getInstance();

        emailText = view.findViewById(R.id.UserEmail);
        nameText = view.findViewById(R.id.UserName);

        logOut = view.findViewById(R.id.LogOut);
        logOut.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnLogOut(v);
            }
        });

        deleteAccount = view.findViewById(R.id.DeleteAccount);
        deleteAccount.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnDeleteAccount(v);
            }
        });

        btChange = view.findViewById(R.id.ChangeName);
        btChange.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnChangeUI();
            }
        });

        suggestPlace = view.findViewById(R.id.SuggestPlace);
        suggestPlace.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnSuggestPlace(v);
            }
        });

        suggestRoute = view.findViewById(R.id.SuggestRoute);
        suggestRoute.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnSuggestRoute(v);
            }
        });

        return view;
        // return super.onCreateView(inflater, container, savedInstanceState);
    }

    @Override
    public void onStart() {
        super.onStart();
        // Check if user is signed in (non-null) and update UI accordingly.
        currentUser = mAuth.getCurrentUser();
        //updateUI(currentUser);
        if (currentUser == null) {
            Log.e("Debug:", "Error, no debería haber aparecido esta pantalla porque el usuario no ha iniciado sesión");
            ((MainActivity)getActivity()).LoadNewFragment(new MenuActivity());
        }
        UpdateUI();
    }

    private void UpdateUI() {
        String name = "";
        String email = "";
        if (currentUser != null) {
            for (UserInfo profile : currentUser.getProviderData()) {
                name = profile.getDisplayName();
                email = profile.getEmail();
            }
        }

        if (name.isEmpty() || email.isEmpty()) {
            Toast toast = Toast.makeText(getActivity(), "No se han podido recuperar los datos del usuario.", Toast.LENGTH_SHORT);
            toast.show();
            return;
        }
        if (emailText != null && nameText != null) {
            emailText.setText(email);
            nameText.setText(name);

            // Accesibility
            emailText.setContentDescription(getString(R.string.email) + email);
            nameText.setContentDescription(getString(R.string.user_name) + name);
        } else {
            Toast toast = Toast.makeText(getActivity(), "No se ha podido acceder al TextView.", Toast.LENGTH_SHORT);
            toast.show();
        }
    }

    public void OnLogOut(android.view.View view) {
        ((MainActivity)getActivity()).newAlertDialog(this, AlertID.LOGOUT, getString(R.string.close_session_dialog));
    }

    public void OnDeleteAccount(android.view.View view) {
        ((MainActivity)getActivity()).newAlertDialog(this, AlertID.DELETEACCOUNT, getString(R.string.delete_account_dialog));
    }

    protected void OnChangeUI(){
        //start changeUI
        if (currentUser != null) {
            //go to the class ChangeUI
            ((MainActivity)getActivity()).LoadNewFragment(new ChangeUI()); //call the constructor
        } else {
            Toast toast = Toast.makeText(getActivity(), getString(R.string.noUser), Toast.LENGTH_SHORT);
            toast.show();
        }
    }

    protected void OnSuggestPlace(android.view.View view) {
        ((MainActivity)getActivity()).LoadNewFragment(new SuggestPlaceActivity());
    }

    protected void OnSuggestRoute(android.view.View view) {
        ((MainActivity)getActivity()).LoadNewFragment(new SuggestRouteActivity());
    }


    @Override
    public void PositiveResponse(AlertID alertID) {
        switch (alertID) {
            case LOGOUT:
                logOut();
                break;
            case DELETEACCOUNT:
                deleteAccount();
                break;
        }
    }

    @Override
    public void NegativeResponse(AlertID alertID) {
        switch (alertID) {
            case LOGOUT:
                break;
            case DELETEACCOUNT:
                break;
        }
    }

    public void logOut() {
        if (mAuth.getCurrentUser() != null) {
            mAuth.signOut();
            Toast toast = Toast.makeText(getActivity(), getString(R.string.logged_out), Toast.LENGTH_SHORT);
            toast.show();
        } else {
            Toast toast = Toast.makeText(getActivity(), getString(R.string.logged_out_fail), Toast.LENGTH_SHORT);
            toast.show();
        }
        ((MainActivity)getActivity()).LoadNewFragment(new MenuActivity());
    }

    public void deleteAccount() {
        currentUser.delete()
                .addOnCompleteListener(new OnCompleteListener<Void>() {
                    @Override
                    public void onComplete(@NonNull Task<Void> task) {
                        if (task.isSuccessful()) {
                            Log.d("Debug:", "User account deleted.");
                            Toast toast = Toast.makeText(getActivity(), getString(R.string.delete_account), Toast.LENGTH_SHORT);
                            toast.show();
                            ((MainActivity)getActivity()).LoadNewFragment(new MenuActivity());
                        } else {
                            Toast toast = Toast.makeText(getActivity(), getString(R.string.delete_account_fail), Toast.LENGTH_SHORT);
                            toast.show();
                            mAuth.signOut();
                            ((MainActivity)getActivity()).LoadNewFragment(new AccountActivity());
                        }
                    }
                });
    }
}
