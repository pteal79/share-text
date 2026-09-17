package com.pteal79.plugins.sharetext

import android.content.Context
import android.content.Intent
import android.util.Log
import com.nativephp.mobile.bridge.BridgeFunction
import com.nativephp.mobile.bridge.BridgeResponse

/** Plain-text sharing. Namespace: "ShareText.*" */
object ShareTextFunctions {
    private const val TAG = "Pteal79ShareText"

    /**
     * Shows the share sheet with a block of text.
     * Parameters:
     *   - text: string - the text to share (required)
     *   - subject: string - used as the subject where the target has one (optional)
     */
    class Text(private val context: Context) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            val text = (parameters["text"] as? String)?.takeIf { it.isNotBlank() }
                ?: return BridgeResponse.error("missing_text", "The text to share is required.")
            val subject = (parameters["subject"] as? String).orEmpty()

            return try {
                val send = Intent(Intent.ACTION_SEND).apply {
                    type = "text/plain"
                    putExtra(Intent.EXTRA_TEXT, text)
                    if (subject.isNotBlank()) {
                        putExtra(Intent.EXTRA_SUBJECT, subject)
                    }
                }

                val chooser = Intent.createChooser(send, null).apply {
                    addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
                }

                context.startActivity(chooser)

                BridgeResponse.success(mapOf("presented" to true))
            } catch (e: Exception) {
                Log.e(TAG, "Could not open the share sheet", e)
                BridgeResponse.error("share_failed", e.message ?: "Could not open the share sheet.")
            }
        }
    }
}
