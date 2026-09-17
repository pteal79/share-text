import Foundation
import UIKit

/// Plain-text sharing. Namespace: "ShareText.*"
enum ShareTextFunctions {

    /// Shows the share sheet with a block of text.
    /// Parameters:
    ///   - text: string - the text to share (required)
    ///   - subject: string - used as the subject where the target has one (optional)
    class Text: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            guard let text = parameters["text"] as? String,
                  !text.trimmingCharacters(in: .whitespacesAndNewlines).isEmpty else {
                return BridgeResponse.error(code: "missing_text", message: "The text to share is required.")
            }

            let subject = parameters["subject"] as? String ?? ""

            DispatchQueue.main.async {
                guard let presenter = ShareTextFunctions.topViewController() else {
                    return
                }

                // The text goes in as a String, never a URL, so it is sent as a message.
                let activity = UIActivityViewController(activityItems: [text], applicationActivities: nil)

                if !subject.isEmpty {
                    activity.setValue(subject, forKey: "subject")
                }

                // iPad presents the sheet as a popover, which needs an anchor.
                if let popover = activity.popoverPresentationController {
                    popover.sourceView = presenter.view
                    popover.sourceRect = CGRect(x: presenter.view.bounds.midX, y: presenter.view.bounds.midY, width: 0, height: 0)
                    popover.permittedArrowDirections = []
                }

                presenter.present(activity, animated: true)
            }

            return BridgeResponse.success(data: ["presented": true])
        }
    }

    /// The controller on top, so the sheet shows over anything already presented.
    static func topViewController() -> UIViewController? {
        let root = UIApplication.shared.connectedScenes
            .compactMap { $0 as? UIWindowScene }
            .first { $0.activationState == .foregroundActive }?
            .windows
            .first { $0.isKeyWindow }?
            .rootViewController

        var top = root
        while let presented = top?.presentedViewController {
            top = presented
        }
        return top
    }
}
